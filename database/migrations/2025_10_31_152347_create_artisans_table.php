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
        Schema::create('artisans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained();
            $table->string('username');
            $table->string('company_name')->nullable();
            $table->string('e164phone')->nullable();
            $table->string('email');
            $table->string('biography');
            $table->string('website_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('average_rate');
            $table->boolean('offers_delivery');
            $table->timestamps();
        });

        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->morphs('mediable');
            $table->text('category')->nullable(); // Example: gallery, avatar
            $table->text('path');
            $table->text('caption')->nullable();
            $table->timestamps();
        });

        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artisan_id')->nullable();
            $table->string('street');
            $table->string('house_number');
            $table->string('postal_code')->nullable();
            $table->string('city');
            $table->string('country');
            $table->string('address_line_2')->nullable();
            $table->timestamps();
        });

        Schema::create('specialities', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            // $table->enum('category'); // 1. sweet, 2. salty (note: Use Enum case class)
            $table->string('name');
            $table->string('label');
            $table->timestamps();
        });

        Schema::create('artisan_speciality', function (Blueprint $table) {
            $table->id();
            $table->string('artisan_id');
            $table->string('speciality_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artisans');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('specialities');
        Schema::dropIfExists('artisan_speciality');
        Schema::dropIfExists('medias');
    }
};