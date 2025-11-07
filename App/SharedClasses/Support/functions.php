<?php


use JetBrains\PhpStorm\NoReturn;

if(!function_exists("dd")){
    #[NoReturn]
    function dd(mixed $var, bool $die = true): void
    {
        echo "<pre>";
        print_r($var);
        echo "</pre>";

        if($die) {
            die();
        }

    }

}