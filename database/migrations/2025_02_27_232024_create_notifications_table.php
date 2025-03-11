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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
        $table->foreignId('user_id')->constrained('users');
        $table->text('message');
        $table->foreignId('bus_id')->nullable()->constrained('buses');
        $table->foreignId('route_id')->nullable()->constrained('routes');
        $table->timestamp('timestamp');
        $table->boolean('is_read')->default(false);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
