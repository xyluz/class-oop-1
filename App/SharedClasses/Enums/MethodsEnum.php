<?php namespace App\SharedClasses\Enums;

enum MethodsEnum:string
{
    case POST = 'POST';
    case GET = 'GET';
    case PUT = 'PUT';
    case DELETE = 'DELETE';
    case PATCH = 'PATCH';
}
