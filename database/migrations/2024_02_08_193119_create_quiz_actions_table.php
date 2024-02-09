<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Infrastructure\Quiz\Enums\ActionTypeEnum;
use Illuminate\Support\Arr;
use App\Infrastructure\Quiz\Enums\ActionAliasTypeEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quiz_actions', function (Blueprint $table) {
            $table->id();

            $table->enum('alias', Arr::pluck(ActionAliasTypeEnum::cases(), 'value'));
            $table->enum('type', Arr::pluck(ActionTypeEnum::cases(), 'value'));
            $table->string('value')->nullable();

            $table->timestamps();

            $table->unique(['alias', 'type', 'value']);
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
