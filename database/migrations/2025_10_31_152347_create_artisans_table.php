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
            $table->string('name')->unique();
            $table->string('company_name')->nullable();
            $table->string('main_occupation')->nullable();
            $table->string('short_description', 200)->nullable();
            $table->text('about');
            $table->string('website_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('average_rate');
            $table->boolean('offers_delivery');
            $table->boolean('pick_up_on_site');
            $table->timestamps();
        });

        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->morphs('addressable');
            $table->string('street');
            $table->string('house_number');
            $table->string('postal_code')->nullable();
            $table->string('city');
            $table->string('country');
            $table->string('address_line_2')->nullable();
            $table->timestamps();
        });

        Schema::create('baked_goods', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('name');
            $table->string('label');
            $table->string('category');
            $table->timestamps();
        });

        Schema::create('dietary_options', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('name');
            $table->string('label');
            $table->timestamps();
        });

        Schema::create('artisan_baked_good', function (Blueprint $table) {
            $table->id();
            $table->string('artisan_id');
            $table->string('baked_good_id');
            $table->timestamps();
        });

        Schema::create('artisan_dietary_option', function (Blueprint $table) {
            $table->id();
            $table->string('artisan_id');
            $table->string('dietary_option_id');
            $table->timestamps();
        });

        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->morphs('mediable');
            $table->text('category')->nullable(); // Values: gallery, profile_photo, cover
            $table->text('path');
            $table->text('caption')->nullable();
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
        Schema::dropIfExists('baked_goods');
        Schema::dropIfExists('dietary_options');
        Schema::dropIfExists('artisan_baked_good');
        Schema::dropIfExists('artisan_dietary_option');
        Schema::dropIfExists('media');
    }
};