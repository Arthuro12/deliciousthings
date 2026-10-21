<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->foreignId('artisan_id')->nullable()->after('user_id')->constrained()->nullOnDelete();
            $table->text('artisan_response')->nullable();
            $table->decimal('quote_amount', 10, 2)->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->index(['artisan_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->dropIndex(['artisan_id', 'status']);
            $table->dropConstrainedForeignId('artisan_id');
            $table->dropColumn(['artisan_response', 'quote_amount', 'responded_at']);
        });
    }
};
