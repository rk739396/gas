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
        Schema::create('companybalances', function (Blueprint $table) {
            $table->id();
            $table->string('company_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('retailer_id')->nullable();
            $table->string('distributor_id')->nullable();
            $table->string('fos_id')->nullable();
            $table->string('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companybalances');
    }
};
