<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Arr;
use App\Infrastructure\Quiz\Enums\QuestionTypeEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();

            $table->text('question');
            $table->enum('type', Arr::pluck(QuestionTypeEnum::cases(), 'value'));
            $table->unsignedInteger('points')->default(1);
            $table->unsignedBigInteger('quiz_id');

            $table->timestamps();

            $table->foreign('quiz_id')->references('id')->on('quizzes')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_questions');
    }
};
