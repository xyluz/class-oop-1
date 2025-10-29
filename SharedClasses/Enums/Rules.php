<?php

namespace Enums;

use Traits\CallStaticTrait;


/**
 * @method static MIN():string //min
 * @method static MAX():string //max
 * @method static MUST():string
 * @method static NOT():string
 */
enum Rules: string
{
    use CallStaticTrait;

    case MIN = 'min';
    case MAX = 'max';
    case MUST = 'must';
    case NOT = 'not';

    public static function implodeCases(): string
    {
        return  implode(', ', self::cases());
    }

}
