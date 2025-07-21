<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Payment;
use Carbon\Carbon;

class ManageDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample clients
        $clients = [
            [
                'name' => 'Ahmad Rahman',
                'email' => 'ahmad@tokosaya.com',
                'phone' => '081234567890',
                'company_name' => 'Toko Saya Jaya',
                'package_type' => 'premium',
                'status' => 'active',
                'registration_date' => '2024-01-15',
                'expiry_date' => '2025-01-15',
                'notes' => 'Toko retail dengan 3 cabang'
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti@warungmakan.com',
                'phone' => '081234567891',
                'company_name' => 'Warung Makan Sederhana',
                'package_type' => 'basic',
                'status' => 'active',
                'registration_date' => '2024-02-20',
                'expiry_date' => '2025-02-20',
                'notes' => 'Warung makan keluarga'
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@supermarket.com',
                'phone' => '081234567892',
                'company_name' => 'Supermarket Makmur',
                'package_type' => 'enterprise',
                'status' => 'active',
                'registration_date' => '2024-03-10',
                'expiry_date' => '2025-03-10',
                'notes' => 'Supermarket dengan 5 cabang'
            ],
            [
                'name' => 'Dewi Sartika',
                'email' => 'dewi@cafekopi.com',
                'phone' => '081234567893',
                'company_name' => 'Cafe Kopi Nusantara',
                'package_type' => 'premium',
                'status' => 'active',
                'registration_date' => '2024-04-05',
                'expiry_date' => '2025-04-05',
                'notes' => 'Cafe kopi dengan 2 outlet'
            ],
            [
                'name' => 'Rudi Hermawan',
                'email' => 'rudi@toserba.com',
                'phone' => '081234567894',
                'company_name' => 'Toserba Rudi',
                'package_type' => 'basic',
                'status' => 'inactive',
                'registration_date' => '2024-01-10',
                'expiry_date' => '2024-12-10',
                'notes' => 'Toserba - expired'
            ],
            [
                'name' => 'Maya Indah',
                'email' => 'maya@salon.com',
                'phone' => '081234567895',
                'company_name' => 'Salon Maya Indah',
                'package_type' => 'premium',
                'status' => 'active',
                'registration_date' => '2024-05-12',
                'expiry_date' => '2025-05-12',
                'notes' => 'Salon kecantikan'
            ],
            [
                'name' => 'Joko Widodo',
                'email' => 'joko@apotek.com',
                'phone' => '081234567896',
                'company_name' => 'Apotek Sehat',
                'package_type' => 'enterprise',
                'status' => 'active',
                'registration_date' => '2024-06-18',
                'expiry_date' => '2025-06-18',
                'notes' => 'Apotek dengan 3 cabang'
            ],
            [
                'name' => 'Sri Wahyuni',
                'email' => 'sri@bengkel.com',
                'phone' => '081234567897',
                'company_name' => 'Bengkel Motor Sri',
                'package_type' => 'basic',
                'status' => 'active',
                'registration_date' => '2024-07-22',
                'expiry_date' => '2025-07-22',
                'notes' => 'Bengkel motor'
            ]
        ];

        foreach ($clients as $clientData) {
            $client = Client::create($clientData);
            
            // Create sample payments for each client
            $this->createSamplePayments($client);
        }

        $this->command->info('Sample client and payment data created successfully!');
    }

    private function createSamplePayments($client)
    {
        $paymentMethods = ['bank_transfer', 'cash', 'credit_card'];
        $statuses = ['pending', 'approved', 'rejected'];
        
        // Create 2-4 payments per client
        $numPayments = rand(2, 4);
        
        for ($i = 0; $i < $numPayments; $i++) {
            $amount = $this->getPackagePrice($client->package_type);
            $paymentDate = Carbon::parse($client->registration_date)->addDays(rand(0, 30));
            $dueDate = $paymentDate->copy()->addDays(rand(1, 7));
            
            Payment::create([
                'client_id' => $client->id,
                'amount' => $amount,
                'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                'status' => $statuses[array_rand($statuses)],
                'payment_date' => $paymentDate,
                'due_date' => $dueDate,
                'description' => 'Pembayaran paket ' . $client->package_type . ' - ' . ($i + 1),
                'reference_number' => 'REF-' . strtoupper(substr($client->company_name, 0, 3)) . '-' . date('Ymd') . '-' . ($i + 1),
            ]);
        }
    }

    private function getPackagePrice($packageType)
    {
        switch ($packageType) {
            case 'basic':
                return rand(500000, 1000000);
            case 'premium':
                return rand(1500000, 2500000);
            case 'enterprise':
                return rand(3000000, 5000000);
            default:
                return 1000000;
        }
    }
} 