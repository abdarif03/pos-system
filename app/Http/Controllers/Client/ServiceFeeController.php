<?php

declare(strict_types=1);

namespace App\Http\Controllers\Client;

use App\Models\Client;
use App\Models\Payment;
use App\Support\SubscriptionBilling;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ServiceFeeController extends BaseClientController
{
    public function index(): View
    {
        $client = null;
        $payments = collect();
        $subscriptionStatus = null;
        $subscriptionStatusLabel = null;
        $visibleFrom = null;
        $currentPackage = null;
        $inBillingWindow = false;

        $user = Auth::user();
        if ($user !== null && $user->client_id !== null) {
            $client = Client::query()->find($user->client_id);
            if ($client !== null) {
                $currentPackage = SubscriptionBilling::packageForClient($client);
                $payments = $client->payments()
                    ->where('type', Payment::TYPE_SUBSCRIPTION_RENEWAL)
                    ->with('package')
                    ->latest()
                    ->get();
                $subscriptionStatus = SubscriptionBilling::subscriptionStatus($client);
                $subscriptionStatusLabel = SubscriptionBilling::statusLabel($subscriptionStatus);
                $inBillingWindow = SubscriptionBilling::isInBillingWindow($client, $currentPackage);
                if ($currentPackage !== null) {
                    $visibleFrom = SubscriptionBilling::visibleFrom(
                        Carbon::parse($client->expiry_date),
                        (int) $currentPackage->duration_months
                    );
                }
            }
        }

        return view('service-fees.index', compact(
            'client',
            'payments',
            'subscriptionStatus',
            'subscriptionStatusLabel',
            'visibleFrom',
            'currentPackage',
            'inBillingWindow'
        ));
    }
}
