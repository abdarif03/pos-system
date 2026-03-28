<?php

declare(strict_types=1);

namespace App\Support;

use App\Models\Client;
use App\Models\Package;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterface;

final class SubscriptionBilling
{
    public const STATUS_EXPIRED = 'expired';

    public const STATUS_WAITING_PAYMENT = 'waiting_payment';

    public const STATUS_PAID_ACTIVE = 'paid_active';

    public static function packageForClient(Client $client): ?Package
    {
        $slug = strtolower((string) $client->package_type);

        return Package::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->first();
    }

    /**
     * First day the renewal invoice should appear (inclusive).
     */
    public static function visibleFrom(CarbonInterface $expiryDate, int $durationMonths): Carbon
    {
        $expiry = Carbon::parse($expiryDate)->startOfDay();

        if ($durationMonths === 1) {
            return $expiry->copy()->subDays(7);
        }

        return $expiry->copy()->subMonth();
    }

    public static function isInBillingWindow(Client $client, ?Package $package = null): bool
    {
        $package ??= self::packageForClient($client);
        if ($package === null) {
            return false;
        }

        $expiry = Carbon::parse($client->expiry_date)->startOfDay();
        $visible = self::visibleFrom($expiry, (int) $package->duration_months)->startOfDay();
        $today = Carbon::today()->startOfDay();

        return $today->greaterThanOrEqualTo($visible) && $today->lessThanOrEqualTo($expiry);
    }

    public static function hasBlockingSubscriptionInvoice(Client $client): bool
    {
        $periodEnd = Carbon::parse($client->expiry_date)->toDateString();

        return Payment::query()
            ->where('client_id', $client->id)
            ->where('type', Payment::TYPE_SUBSCRIPTION_RENEWAL)
            ->whereDate('billing_period_end', $periodEnd)
            ->where('status', 'pending')
            ->exists();
    }

    public static function subscriptionStatus(Client $client): string
    {
        $expiry = Carbon::parse($client->expiry_date)->startOfDay();
        $today = Carbon::today()->startOfDay();

        if ($today->greaterThan($expiry)) {
            return self::STATUS_EXPIRED;
        }

        if (self::hasBlockingSubscriptionInvoice($client)) {
            return self::STATUS_WAITING_PAYMENT;
        }

        return self::STATUS_PAID_ACTIVE;
    }

    public static function statusLabel(string $status): string
    {
        return match ($status) {
            self::STATUS_EXPIRED => 'Expired',
            self::STATUS_WAITING_PAYMENT => 'Menunggu pembayaran',
            self::STATUS_PAID_ACTIVE => 'Sudah dibayar / aktif',
            default => $status,
        };
    }

    /**
     * True if an invoice already exists for this billing period (pending or approved).
     */
    public static function subscriptionInvoiceExistsForPeriod(Client $client, CarbonInterface $periodEnd): bool
    {
        return Payment::query()
            ->where('client_id', $client->id)
            ->where('type', Payment::TYPE_SUBSCRIPTION_RENEWAL)
            ->whereDate('billing_period_end', Carbon::parse($periodEnd)->toDateString())
            ->whereIn('status', ['pending', 'approved'])
            ->exists();
    }

    /**
     * POS operasional (produk, transaksi, pengaturan user) hanya jika langganan aktif / lunas.
     */
    public static function canAccessPosFeatures(?User $user): bool
    {
        if ($user === null || $user->client_id === null) {
            return false;
        }

        $client = Client::query()->find($user->client_id);
        if ($client === null || $client->status !== 'active') {
            return false;
        }

        return self::subscriptionStatus($client) === self::STATUS_PAID_ACTIVE;
    }
}
