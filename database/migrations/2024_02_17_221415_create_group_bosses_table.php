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
        Schema::create('group_bosses', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('post_id');
            $table->string('name');
            $table->text('post_content');
            $table->string('image')->nullable();
            $table->unsignedInteger('max_health');
            $table->unsignedInteger('current_health');
            $table->unsignedInteger('base_hit_chance')->default(100);
            $table->unsignedInteger('hit_cooldown');
            $table->unsignedInteger('miss_cooldown');
            $table->unsignedBigInteger('killed_by')->nullable();
            $table->timestamp('killed_at')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_bosses');
    }
};
