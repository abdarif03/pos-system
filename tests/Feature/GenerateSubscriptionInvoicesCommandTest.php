<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Package;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class GenerateSubscriptionInvoicesCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_command_is_idempotent_for_same_billing_period(): void
    {
        Carbon::setTestNow('2026-06-20');

        $pkg = Package::query()->create([
            'name' => 'Basic',
            'slug' => 'basic',
            'description' => 'd',
            'price' => 100000,
            'duration_months' => 1,
            'features' => [],
            'is_active' => true,
        ]);

        $client = Client::query()->create([
            'name' => 'A',
            'email' => 'inv@test.com',
            'phone' => '081',
            'company_name' => 'Co',
            'package_type' => 'basic',
            'status' => 'active',
            'registration_date' => '2026-01-01',
            'expiry_date' => '2026-06-27',
        ]);

        Artisan::call('subscriptions:generate-invoices');
        $this->assertDatabaseCount('payments', 1);

        $payment = Payment::query()->first();
        $this->assertSame(Payment::TYPE_SUBSCRIPTION_RENEWAL, $payment->type);
        $this->assertTrue($payment->package_id === $pkg->id);

        Artisan::call('subscriptions:generate-invoices');
        $this->assertDatabaseCount('payments', 1);

        Carbon::setTestNow();
    }
}
