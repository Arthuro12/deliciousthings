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
            $table->double('lat')->nullable()->after('address_line_2');
            $table->double('lon')->nullable()->after('lat');
            $table->string('formatted')->nullable()->after('lon');
            $table->boolean('shows_full_address')->default(false)->after('formatted');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn('lat');
            $table->dropColumn('lon');
            $table->dropColumn('formatted');
            $table->dropColumn('shows_full_address');
        });
    }
};