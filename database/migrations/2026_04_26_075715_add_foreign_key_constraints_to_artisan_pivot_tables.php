<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('artisan_baked_good', function (Blueprint $table) {
            DB::table('artisan_baked_good')
                ->leftJoin('artisans', 'artisan_baked_good.artisan_id', '=', 'artisans.id')
                ->leftJoin('baked_goods', 'artisan_baked_good.baked_good_id', '=', 'baked_goods.id')
                ->where(function ($query) {
                    $query->whereNull('artisans.id')
                        ->orWhereNull('baked_goods.id')
                        ->orWhereNull('artisan_baked_good.baked_good_id');
                })->delete();

            $table->unsignedBigInteger('artisan_id')->change();
            $table->unsignedBigInteger('baked_good_id')->change();
            
            $table->foreign('artisan_id')->references('id')->on('artisans')->onDelete('cascade');
            $table->foreign('baked_good_id')->references('id')->on('baked_goods')->onDelete('cascade');
            $table->unique(['artisan_id', 'baked_good_id']);
        });

        Schema::table('artisan_dietary_option', function (Blueprint $table) {
            DB::table('artisan_dietary_option')
                ->leftJoin('artisans', 'artisan_dietary_option.artisan_id', '=', 'artisans.id')
                ->leftJoin('dietary_options', 'artisan_dietary_option.dietary_option_id', '=', 'dietary_options.id')
                ->where(function ($query) {
                    $query->whereNull('artisans.id')
                        ->orWhereNull('dietary_options.id')
                        ->orWhereNull('artisan_dietary_option.dietary_option_id');
                })->delete();

            $table->unsignedBigInteger('artisan_id')->change();
            $table->unsignedBigInteger('dietary_option_id')->change();
            
            $table->foreign('artisan_id')->references('id')->on('artisans')->onDelete('cascade');
            $table->foreign('dietary_option_id')->references('id')->on('dietary_options')->onDelete('cascade');
            $table->unique(['artisan_id', 'dietary_option_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('artisan_baked_good', function (Blueprint $table) {
            $table->dropForeign(['artisan_id']);
            $table->dropForeign(['baked_good_id']);

            $table->string('artisan_id')->change();
            $table->string('baked_good_id')->change();
            $table->dropUnique(['artisan_id', 'baked_good_id']);
        });

        Schema::table('artisan_dietary_option', function (Blueprint $table) {
            $table->dropForeign(['artisan_id']);
            $table->dropForeign(['dietary_option_id']);

            $table->string('artisan_id')->change();
            $table->string('dietary_option_id')->change();
            $table->unique(['artisan_id', 'dietary_option_id']);
        });
    }
};