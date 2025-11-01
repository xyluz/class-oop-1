<?php

namespace App\SharedClasses\Objects;

class SingleRuleCollection
{

    public function __construct(
        public string $field,
        public string $rules
    )
    {
    }

}