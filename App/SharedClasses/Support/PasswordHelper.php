<?php

namespace App\SharedClasses\Support;
class PasswordHelper
{
    public static function checkHasSpecialCharacter($passwordToArray): bool
    {
        return preg_match('/[^a-zA-Z0-9\s]/', $passwordToArray);
    }

    public static function shouldHaveAlpha($input): false|int
    {
        return preg_match('/[a-zA-Z]/', $input);
    }

    public static function shouldHaveNumeric($input): false|int
    {
        return preg_match('/\d/', $input);
    }

    public static function shouldHaveLowercase(int|string $input): bool
    {
        return preg_match('/[a-z]/', $input);
    }

    public static function shouldHaveUppercase(int|string $input): bool
    {
        return preg_match('/[A-Z]/', $input);
    }

}