<?php

use App\Constants\DatabaseConstants;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(DatabaseConstants::LESSONS_TABLE, static function (Blueprint $table) {
            $table->uuid(DatabaseConstants::LESSONS_TABLE_ID)->primary();
            $table->string(DatabaseConstants::LESSONS_TABLE_NAME, 30)->unique();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(DatabaseConstants::LESSONS_TABLE);
    }
};
