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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->text('text');
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('peer_id');

            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unique(['peer_id', 'name']);
            $table->index('peer_id');
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
