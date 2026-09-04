<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enums\ServiceRequestStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('service_requests', function (Blueprint $table) {
         $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('status', 32)
                ->default(ServiceRequestStatus::Draft->value);

            $table->text('description');

            $table->string('category', 100)
                ->nullable();

            $table->string('occasion', 100)
                ->nullable();

            $table->date('event_date')
                ->nullable();

            $table->time('event_time')
                ->nullable();

            $table->unsignedSmallInteger('participants')
                ->nullable();

            $table->string('location_text', 255)
                ->nullable();

            $table->decimal('budget_min', 10, 2)
                ->nullable();

            $table->decimal('budget_max', 10, 2)
                ->nullable();

            $table->char('currency', 3)
                ->default('EUR');

            $table->string('fulfillment_method', 50)
                ->nullable();

            $table->json('style')
                ->nullable();

            $table->json('flavors')
                ->nullable();

            $table->text('requirements')
                ->nullable();

            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index(['status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};