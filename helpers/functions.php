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

if(!function_exists("redirect")){
    #[NoReturn]
    function redirect($url = null, $data = null, $message = null, $type = "success"): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($message !== null) $_SESSION['message'] = $message;
        if ($data !== null) $_SESSION['data'] = $data;
        if ($type !== null) $_SESSION['type'] = $type;

        $url = empty($url) ? $_SERVER['HTTP_REFERER'] ?? '/' : $url;

        header("Location: $url");
        exit;
    }

}
