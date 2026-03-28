<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\Client;
use App\Models\Package;
use App\Models\Payment;
use App\Support\SubscriptionBilling;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriptionBillingTest extends TestCase
{
    use RefreshDatabase;

    public function test_visible_from_one_month_package_is_seven_days_before_expiry(): void
    {
        $expiry = Carbon::parse('2026-06-30')->startOfDay();
        $visible = SubscriptionBilling::visibleFrom($expiry, 1);

        $this->assertTrue($visible->equalTo(Carbon::parse('2026-06-23')->startOfDay()));
    }

    public function test_visible_from_three_month_package_is_one_month_before_expiry(): void
    {
        $expiry = Carbon::parse('2026-06-30')->startOfDay();
        $visible = SubscriptionBilling::visibleFrom($expiry, 3);

        $this->assertTrue($visible->equalTo(Carbon::parse('2026-05-30')->startOfDay()));
    }

    public function test_package_for_client_resolves_by_slug(): void
    {
        Package::query()->create([
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
            'email' => 'a@test.com',
            'phone' => '081',
            'company_name' => 'Co',
            'package_type' => 'basic',
            'status' => 'active',
            'registration_date' => '2026-01-01',
            'expiry_date' => '2026-12-31',
        ]);

        $pkg = SubscriptionBilling::packageForClient($client);
        $this->assertNotNull($pkg);
        $this->assertSame('basic', $pkg->slug);
    }

    public function test_subscription_status_expired_when_past_expiry(): void
    {
        Package::query()->create([
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
            'email' => 'b@test.com',
            'phone' => '081',
            'company_name' => 'Co',
            'package_type' => 'basic',
            'status' => 'active',
            'registration_date' => '2025-01-01',
            'expiry_date' => '2020-01-01',
        ]);

        $this->assertSame(SubscriptionBilling::STATUS_EXPIRED, SubscriptionBilling::subscriptionStatus($client));
    }

    public function test_subscription_status_waiting_when_pending_renewal_exists(): void
    {
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
            'email' => 'c@test.com',
            'phone' => '081',
            'company_name' => 'Co',
            'package_type' => 'basic',
            'status' => 'active',
            'registration_date' => '2026-01-01',
            'expiry_date' => '2026-12-31',
        ]);

        Payment::query()->create([
            'client_id' => $client->id,
            'type' => Payment::TYPE_SUBSCRIPTION_RENEWAL,
            'package_id' => $pkg->id,
            'billing_period_end' => $client->expiry_date->toDateString(),
            'amount' => 100000,
            'payment_method' => 'other',
            'status' => 'pending',
            'payment_date' => '2026-06-01',
            'due_date' => $client->expiry_date->toDateString(),
        ]);

        $this->assertSame(SubscriptionBilling::STATUS_WAITING_PAYMENT, SubscriptionBilling::subscriptionStatus($client));
    }

    public function test_subscription_status_paid_active_without_pending(): void
    {
        Package::query()->create([
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
            'email' => 'd@test.com',
            'phone' => '081',
            'company_name' => 'Co',
            'package_type' => 'basic',
            'status' => 'active',
            'registration_date' => '2026-01-01',
            'expiry_date' => '2026-12-31',
        ]);

        $this->assertSame(SubscriptionBilling::STATUS_PAID_ACTIVE, SubscriptionBilling::subscriptionStatus($client));
    }
}
