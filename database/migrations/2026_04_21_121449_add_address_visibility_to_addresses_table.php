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
        Schema::table('addresses', function (Blueprint $table) {
            $table->enum('visibility', ['public', 'city', 'private'])->default('city')->after('formatted');

            $table->dropColumn('shows_full_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->boolean('shows_full_address')->default(false)->after('formatted');

            $table->dropColumn('visibility');
        });
    }
};