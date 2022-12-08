<?php

use App\Constants\DatabaseConstants;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(DatabaseConstants::USER_LESSONS_TABLE, static function (Blueprint $table) {
            $table->uuid(DatabaseConstants::USER_LESSONS_TABLE_ID)->primary();
            $table->foreignUuid(DatabaseConstants::USER_LESSONS_TABLE_USER_ID)->constrained()->cascadeOnDelete();
            $table->foreignUuid(DatabaseConstants::USER_LESSONS_TABLE_LESSON_ID)->constrained()->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(DatabaseConstants::USER_LESSONS_TABLE);
    }
};
