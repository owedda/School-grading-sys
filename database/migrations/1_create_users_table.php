<?php

declare(strict_types=1);

use App\Common\UnitEnumToArrayConverter;
use App\Constants\DatabaseConstants;
use App\Models\UserTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(DatabaseConstants::USERS_TABLE, static function (Blueprint $table) {
            $userTypesArray = UnitEnumToArrayConverter::getArrayWithEnumNameValues(UserTypeEnum::cases());
            $table->uuid(DatabaseConstants::USERS_TABLE_ID)->primary();
            $table->string(DatabaseConstants::USERS_TABLE_USERNAME)->unique();
            $table->string(DatabaseConstants::USERS_TABLE_NAME);
            $table->string(DatabaseConstants::USERS_TABLE_LAST_NAME);
            $table->enum(DatabaseConstants::USERS_TABLE_TYPE, $userTypesArray);
            $table->string(DatabaseConstants::USERS_TABLE_EMAIL)->unique();
            $table->string(DatabaseConstants::USERS_TABLE_PASSWORD);
            $table->rememberToken();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(DatabaseConstants::USERS_TABLE);
    }
};
