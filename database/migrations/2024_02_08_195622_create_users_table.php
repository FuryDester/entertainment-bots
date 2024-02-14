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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('vk_user_id');
            $table->unsignedBigInteger('vk_peer_id');
            $table->boolean('is_admin')->default(false);

            $table->string('state')->default('');
            $table->json('data')->nullable();
            $table->timestamp('last_activity_at')->nullable();

            $table->timestamps();

            $table->unique(['vk_user_id', 'vk_peer_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
