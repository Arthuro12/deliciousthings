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
        Schema::create('pre_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artisan_id')->constrained();
            $table->string('owner_name');
            $table->string('owner_email');
            $table->integer('total_guests')->nullable();
            $table->dateTime('withdrawal_at');
            $table->text('message')->nullable();
            $table->timestamps();
        });

        Schema::create('baked_good_pre_order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('baked_good_id')->constrained();
            $table->foreignId('pre_order_id')->constrained();
            $table->integer('quantity')->nullable();
            $table->timestamps();
        });

        Schema::create('service_pre_order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained();
            $table->foreignId('pre_order_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baked_good_pre_order');
        Schema::dropIfExists('service_pre_order');
        Schema::dropIfExists('pre_orders');
    }
};