<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\ClientWelcomeMail;
use App\Models\Client;
use App\Models\MailLog;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ClientRegistrationController extends Controller
{
    private const ALLOWED_PACKAGES = ['basic', 'premium', 'enterprise'];

    public function create(Request $request): View|RedirectResponse
    {
        $package = strtolower((string) $request->query('package', 'basic'));
        if (! in_array($package, self::ALLOWED_PACKAGES, true)) {
            return redirect()->route('pricing')->with('error', 'Paket tidak valid.');
        }

        return view('web.client-register', [
            'packageType' => $package,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('clients', 'email')->where('status', 'active'),
                function (string $attribute, mixed $value, \Closure $fail) {
                    $blocked = User::query()
                        ->where('email', $value)
                        ->where(function ($q) {
                            $q->whereNull('client_id')
                                ->orWhereHas('client', fn ($c) => $c->where('status', 'active'));
                        })
                        ->exists();
                    if ($blocked) {
                        $fail('Email ini sudah terdaftar pada akun client yang masih aktif.');
                    }
                },
            ],
            'phone' => ['required', 'string', 'max:20'],
            'company_name' => ['required', 'string', 'max:255'],
            'package_type' => ['required', 'in:basic,premium,enterprise'],
        ], [
            'email.unique' => 'Email ini sudah digunakan oleh client yang masih aktif.',
        ]);

        $trialDays = max(1, (int) config('client.trial_days', 14));
        $today = Carbon::today();
        $expiry = $today->copy()->addDays($trialDays);

        $adminRoleId = Role::query()->where('name', 'Admin')->value('id');

        $plainPassword = Str::password(14, true, true, true, false);

        [$client, $user] = DB::transaction(function () use ($validated, $today, $expiry, $adminRoleId, $plainPassword) {
            User::query()
                ->where('email', $validated['email'])
                ->whereNotNull('client_id')
                ->whereHas('client', fn ($q) => $q->where('status', 'inactive'))
                ->each(function (User $legacyUser) {
                    $legacyUser->update([
                        'email' => sprintf('archived+%d+%s@invalid.invalid', $legacyUser->id, bin2hex(random_bytes(4))),
                    ]);
                });

            $client = Client::query()->create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'company_name' => $validated['company_name'],
                'package_type' => $validated['package_type'],
                'status' => 'active',
                'registration_date' => $today->toDateString(),
                'expiry_date' => $expiry->toDateString(),
                'notes' => 'Registrasi mandiri dari website.',
            ]);

            $user = User::query()->create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $plainPassword,
                'role' => 'admin',
                'role_id' => $adminRoleId,
                'client_id' => $client->id,
            ]);

            return [$client, $user];
        });

        $loginUrl = config('client.url').'/login';

        $mailable = new ClientWelcomeMail($user, $plainPassword, $client, $loginUrl);
        $mailLog = MailLog::query()->create([
            'type' => 'client_welcome',
            'to_email' => $user->email,
            'subject' => $mailable->envelope()->subject,
            'status' => MailLog::STATUS_PENDING,
            'client_id' => $client->id,
            'user_id' => $user->id,
        ]);

        try {
            Mail::to($user->email)->send($mailable);
            $mailLog->update([
                'status' => MailLog::STATUS_SENT,
                'sent_at' => now(),
            ]);
        } catch (\Throwable $e) {
            $mailLog->update([
                'status' => MailLog::STATUS_FAILED,
                'error_message' => $e->getMessage(),
            ]);
            Log::error('Client welcome mail failed: '.$e->getMessage(), [
                'exception' => $e,
                'mail_log_id' => $mailLog->id,
            ]);
        }

        return redirect()
            ->route('client.register.thanks')
            ->with('success', 'Registrasi berhasil. Periksa email Anda untuk kredensial login.');
    }

    public function thanks(): View
    {
        return view('web.client-register-thanks');
    }
}
