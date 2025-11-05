<?php

namespace App\SharedClasses\Enums;

use App\SharedClasses\Traits\CallStaticTrait;
use App\SharedClasses\Traits\SharedEnumMethods;

/**
 * @method static MIN():string //min
 * @method static MAX():string //max
 * @method static MUST():string
 * @method static NOT():string
 * @method static SHOULD():string
 */
enum Rules: string
{
    use CallStaticTrait;
    use SharedEnumMethods;

    case MIN = 'min';
    case MAX = 'max';
    case MUST = 'must';
    case NOT = 'not';
    case SHOULD = 'should';

}
