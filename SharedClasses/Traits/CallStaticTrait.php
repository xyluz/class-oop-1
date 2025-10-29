<?php

namespace Traits;


trait CallStaticTrait
{

    public static function __callStatic(string $name, array $arguments)
    {
        if (defined("self::{$name}")) {
            return self::{$name}->value;
        }
    }

}