<?php

namespace App\SharedClasses\Enums;

enum StatusCode:int
{
    case SUCCESS = 200;
    case NOT_FOUND = 404;
    case SEVER_ERROR = 500;
    case VALIDATION_ERROR = 422;
    case OTHERS = 760; //not a thing
}
