<?php

namespace App\SharedClasses\Objects;

use App\SharedClasses\Enums\Rules;

class RulesCollection
{

    public function __construct(
        public array $rules
    )
    {
    }


}