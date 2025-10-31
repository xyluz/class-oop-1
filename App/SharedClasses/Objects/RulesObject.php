<?php

namespace App\SharedClasses\Objects;

class RulesObject
{

    public function __construct(
        public string $one = 'one',
        public string $two = 'two',
    )
    {
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}