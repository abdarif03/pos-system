<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Support\SubscriptionBilling;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureActiveSubscription
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if ($user === null) {
            return redirect()->route('login');
        }

        if ($user->client_id === null) {
            return redirect()
                ->route('service-fees.index')
                ->with('warning', 'Akun Anda belum terhubung ke data klien. Hubungi administrator.');
        }

        if (! SubscriptionBilling::canAccessPosFeatures($user)) {
            return redirect()
                ->route('service-fees.index')
                ->with('warning', 'Selesaikan pembayaran biaya layanan untuk mengakses fitur ini.');
        }

        return $next($request);
    }
}
