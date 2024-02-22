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
        Schema::create('quiz_actions', function (Blueprint $table) {
            $table->id();

            $table->string('alias');
            $table->string('type');
            $table->json('data')->nullable();
            $table->unsignedInteger('duration')->default(0)->nullable();

            $table->timestamps();

            $table->unique(['alias', 'type', 'data', 'duration']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_actions');
    }
};
