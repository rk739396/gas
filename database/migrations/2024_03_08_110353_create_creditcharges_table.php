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
        Schema::create('creditcharges', function (Blueprint $table) {
            $table->id();
            $table->string('sup_dist_id')->nullable();
            $table->string('distributor_id')->nullable();
            $table->string('company_id')->nullable();
            $table->string('retailer_id')->nullable();
            $table->string('cr_amount')->nullable();
            $table->string('total_balance')->nullable();
            $table->string('remarks', 2000)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creditcharges');
    }
};
