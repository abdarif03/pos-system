<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('type', 32)->default('manual')->after('client_id');
            $table->foreignId('package_id')->nullable()->after('type')->constrained()->nullOnDelete();
            $table->date('billing_period_end')->nullable()->after('package_id');
            $table->index(['client_id', 'billing_period_end', 'type'], 'payments_client_billing_type_idx');
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropIndex('payments_client_billing_type_idx');
            $table->dropConstrainedForeignId('package_id');
            $table->dropColumn(['type', 'billing_period_end']);
        });
    }
};
