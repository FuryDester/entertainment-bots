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
        Schema::create('group_boss_weapons', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('group_boss_id');
            $table->string('name');
            $table->string('hit_damage_template')->nullable();
            $table->integer('min_damage');
            $table->integer('max_damage');
            $table->unsignedInteger('hit_chance')->default(100);

            $table->timestamps();

            $table->unique(['group_boss_id', 'name']);
            $table->foreign('group_boss_id')->references('id')->on('group_bosses')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_boss_weapons');
    }
};
