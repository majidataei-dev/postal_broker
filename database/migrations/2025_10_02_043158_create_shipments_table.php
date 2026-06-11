<?php

use App\Models\User;
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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'sender_id');
            $table->foreignIdFor(User::class, 'receiver_id');
            $table->string('tracking_code', 24)->unique();
            $table->enum('service_type', ['standard', 'express', 'priority', 'international'])->default('standard');
            $table->enum('package_type', ['document','parcel','fragile','perishable','valuable'])->default('document');
            $table->json('packages');
            $table->enum('status', ['pending', 'shipped', 'delivered'])->default('pending');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
