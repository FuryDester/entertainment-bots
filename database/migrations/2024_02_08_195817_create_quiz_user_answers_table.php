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
        Schema::create('quiz_user_answers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('answer_id')->nullable();
            $table->string('answer_text')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamp('answered_at')->useCurrent();

            $table->timestamps();

            $table->foreign('question_id')->references('id')->on('quiz_questions')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_user_answers');
    }
};
