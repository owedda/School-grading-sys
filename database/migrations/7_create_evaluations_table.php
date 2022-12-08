<?php

use App\Constants\DatabaseConstants;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(DatabaseConstants::EVALUATIONS_TABLE, static function (Blueprint $table) {
            $table->uuid(DatabaseConstants::EVALUATIONS_TABLE_ID)->primary();
            $table->integer(DatabaseConstants::EVALUATIONS_TABLE_VALUE);
            $table->foreignUuid(DatabaseConstants::EVALUATIONS_TABLE_USER_LESSON_ID)->constrained()->cascadeOnDelete();
            $table->date(DatabaseConstants::EVALUATIONS_TABLE_DATE);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(DatabaseConstants::EVALUATIONS_TABLE);
    }
};
