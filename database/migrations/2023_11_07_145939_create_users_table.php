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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('distributor_id')->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('shop')->nullable();
            $table->string('refrence')->nullable();
            $table->string('adhaar')->nullable();
            $table->string('pan')->nullable();
            $table->string('date')->nullable();
            $table->string('password')->nullable();
            $table->string('address', 1000)->nullable();
            $table->string('per_address', 1000)->nullable();
            $table->string('role')->nullable();
            $table->string('fos')->nullable();
            $table->string('status')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
