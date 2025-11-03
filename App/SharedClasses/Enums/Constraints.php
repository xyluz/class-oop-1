<?php

namespace App\SharedClasses\Enums;

use App\SharedClasses\Traits\CallStaticTrait;
use App\SharedClasses\Traits\SharedEnumMethods;

enum Constraints:string
{

    use CallStaticTrait;
    use SharedEnumMethods;

    case ALPHA = 'alpha';
    case NUMERIC = 'numeric';
    case ALPHA_NUMERIC = 'alpha_numeric';
    case ARRAY = 'array';
    case UPPERCASE = 'uppercase';
    case LOWERCASE = 'lowercase';
    case SPECIAL_CHARACTER = 'special_character';

}
