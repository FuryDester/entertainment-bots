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
        Schema::create('group_boss_user_actions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('group_boss_id');
            $table->unsignedBigInteger('group_boss_weapon_id');
            $table->unsignedInteger('damage');
            $table->boolean('is_miss')->default(false);

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->restrictOnDelete();
            $table->foreign('group_boss_id')->references('id')->on('group_bosses')->restrictOnDelete();
            $table->foreign('group_boss_weapon_id')->references('id')->on('group_boss_weapons')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_boss_user_actions');
    }
};
