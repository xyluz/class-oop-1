<?php

namespace App\SharedClasses\Traits;

trait SharedEnumMethods
{
    public static function toString(): string
    {
        return  implode(', ', self::cases());
    }

    public static function toArray(): array{
        return self::cases();
    }

}