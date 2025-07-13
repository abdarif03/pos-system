<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaction;
use Carbon\Carbon;

class MarkExpiredTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transactions:mark-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark transactions as expired if they have not been updated for 2 hours';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $twoHoursAgo = Carbon::now()->subHours(2);
        
        $expiredTransactions = Transaction::where('status', Transaction::STATUS_NEW)
            ->where('created_at', '<=', $twoHoursAgo)
            ->get();
        
        $count = 0;
        
        foreach ($expiredTransactions as $transaction) {
            $transaction->update(['status' => Transaction::STATUS_EXPIRED]);
            $count++;
            
            $this->info("Transaction ID {$transaction->id} marked as expired");
        }
        
        if ($count > 0) {
            $this->info("Successfully marked {$count} transaction(s) as expired");
        } else {
            $this->info("No transactions found to mark as expired");
        }
        
        return 0;
    }
}
