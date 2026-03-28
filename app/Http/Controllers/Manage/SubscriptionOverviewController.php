<?php

declare(strict_types=1);

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Support\SubscriptionBilling;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class SubscriptionOverviewController extends Controller
{
    public function index(Request $request): View
    {
        /** @var Collection<int, array{client: Client, status: string, status_label: string}> $rows */
        $rows = Client::query()
            ->orderBy('company_name')
            ->get()
            ->map(function (Client $client) {
                $status = SubscriptionBilling::subscriptionStatus($client);

                return [
                    'client' => $client,
                    'status' => $status,
                    'status_label' => SubscriptionBilling::statusLabel($status),
                ];
            });

        if ($request->filled('status')) {
            $filter = (string) $request->input('status');
            $rows = $rows->filter(fn (array $row) => $row['status'] === $filter)->values();
        }

        return view('manage.subscriptions.index', [
            'rows' => $rows,
            'statusFilter' => $request->input('status', ''),
        ]);
    }
}
