<?php

declare(strict_types=1);

namespace App\Service;

use UnitEnum;

final class UnitEnumToArrayConverter
{
    public static function getArrayWithEnumNameValues(array $unitEnum): array
    {
        return array_map(
            static fn (UnitEnum $type) => $type->name,
            $unitEnum
        );
    }
}
