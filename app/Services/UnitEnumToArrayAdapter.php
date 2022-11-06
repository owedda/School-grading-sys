<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\UserType;
use Illuminate\Validation\Rules\Enum;
use UnitEnum;

class UnitEnumToArrayAdapter
{
    static public function getArrayWithEnumNameValues(array $unitEnum): array
    {
        return array_map(
            fn (UnitEnum $type) => $type->name,
            $unitEnum
        );
    }
}
