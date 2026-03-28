<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Client;
use App\Models\Payment;
use App\Support\SubscriptionBilling;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateSubscriptionInvoices extends Command
{
    protected $signature = 'subscriptions:generate-invoices';

    protected $description = 'Create subscription renewal payment rows when clients enter the billing reminder window';

    public function handle(): int
    {
        $today = Carbon::today()->startOfDay();
        $created = 0;

        Client::query()
            ->where('status', 'active')
            ->orderBy('id')
            ->each(function (Client $client) use ($today, &$created) {
                $package = SubscriptionBilling::packageForClient($client);
                if ($package === null) {
                    return;
                }

                $expiry = Carbon::parse($client->expiry_date)->startOfDay();
                $visible = SubscriptionBilling::visibleFrom($expiry, (int) $package->duration_months)->startOfDay();

                if ($today->lessThan($visible)) {
                    return;
                }

                if (SubscriptionBilling::subscriptionInvoiceExistsForPeriod($client, $expiry)) {
                    return;
                }

                Payment::query()->create([
                    'client_id' => $client->id,
                    'type' => Payment::TYPE_SUBSCRIPTION_RENEWAL,
                    'package_id' => $package->id,
                    'billing_period_end' => $expiry->toDateString(),
                    'amount' => $package->price,
                    'payment_method' => 'other',
                    'status' => 'pending',
                    'payment_date' => $today->toDateString(),
                    'due_date' => $expiry->toDateString(),
                    'description' => sprintf(
                        'Perpanjangan langganan paket %s — jatuh tempo %s',
                        $package->name,
                        $expiry->translatedFormat('d M Y')
                    ),
                ]);

                $created++;
            });

        $this->info("Created {$created} subscription invoice(s).");

        return self::SUCCESS;
    }
}
