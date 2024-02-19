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
        Schema::create('user_actions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('quiz_action_id');
            $table->timestamp('ends_at')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->restrictOnDelete();
            $table->foreign('quiz_action_id')->references('id')->on('quiz_actions')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_actions');
    }
};
