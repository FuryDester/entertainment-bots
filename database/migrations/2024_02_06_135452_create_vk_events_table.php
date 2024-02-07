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
        Schema::create('vk_events', static function (Blueprint $table) {
            $table->id();

            $table->string('event_id', 40)->unique()->index();
            $table->string('type', 32);
            $table->string('version', 16);
            $table->unsignedInteger('group_id');
            $table->text('object');
            $table->boolean('is_processed')->default(false);
            $table->unsignedSmallInteger('attempts')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vk_events');
    }
};
