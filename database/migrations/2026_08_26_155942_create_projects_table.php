<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enums\FulfillmentMethod;
use App\Enums\ProjectStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('owner_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('name', 100);
            $table->enum('status', ProjectStatus::cases());
            $table->unsignedSmallInteger('servings')->nullable();

            $table->text('description')->nullable();
            $table->string('event_name');
            $table->date('event_date')->nullable();
            $table->time('event_time')->nullable();
            $table->decimal('budget', 10, 2)->nullable();
            $table->char('currency', 3)->default('EUR');
            $table->enum('fullfilment_method', FulfillmentMethod::cases());
            
            $table->softDeletes();

            $table->index(['owner_user_id', 'status']);
            $table->index('event_date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};