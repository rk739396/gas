<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('topups', function (Blueprint $table) {
            $table->id();
            $table->string('distributor_id')->nullable();
            $table->string('fos_id')->nullable();
            $table->string('topup_id')->nullable();
            $table->string('company_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('user_id')->nullable();
            $table->string('retailer_remarks', 2000)->nullable();
            $table->string('month')->nullable();
            $table->string('date')->nullable();
            $table->string('status')->nullable();
            $table->string('approver_id')->nullable();
            $table->string('total_balance')->nullable();
            $table->string('topup_remarks', 2000)->nullable();
            $table->string('payment_status')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('payment_date')->nullable();
            $table->string('image')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('payment_remarks', 2000)->nullable();
            $table->string('paycollection_id')->nullable();
            $table->string('payment_collect')->nullable();
            $table->string('collect_date')->nullable();
            $table->string('collect_remarks', 2000)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topups');
    }
};
