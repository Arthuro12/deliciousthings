<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('creations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artisan_id')->constrained()->cascadeOnDelete();
            $table->string('title', 120);
            $table->text('description');
            $table->decimal('price', 10, 2)->nullable();
            $table->boolean('price_on_request')->default(false);
            $table->boolean('is_published')->default(false);
            $table->timestamps();
            $table->index(['artisan_id', 'is_published']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('creations');
    }
};
