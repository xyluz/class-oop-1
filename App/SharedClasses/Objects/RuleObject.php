<?php

namespace App\SharedClasses\Objects;

use App\SharedClasses\Enums\Constraints;
use App\SharedClasses\Enums\Rules;

class RuleObject
{

    public function __construct(
        public ?Rules $rules = null,
        public ?Constraints $constraints = null,
    )
    {
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function fromString(string $string):static{
        return self::fromArray(explode('|',$string));
    }

    public static function fromArray(array $array):self{
        return new self(...$array);
    }
}