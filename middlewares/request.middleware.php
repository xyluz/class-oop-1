<?php


use App\SharedClasses\Enums\MethodsEnum;
use App\SharedClasses\Objects\User;
use App\SharedClasses\Objects\UserRequestObject;

$endpoint = str_replace('/','',$_SERVER['REQUEST_URI']);

$makeControllerName = "App\SharedClasses\Controller\\". ucwords($endpoint) . 'Controller';

$requestMethod = $_SERVER['REQUEST_METHOD'];

$method = 'index';

$requestObject = "App\SharedClasses\Objects\Requests\\". ucwords($endpoint) . 'Request';

$request = new $requestObject(
    method: MethodsEnum::{$requestMethod},
    user: getUserObject(),
    body: UserRequestObject::fromArray(extractRequestBody($requestMethod))
);


$controller = (new $makeControllerName($request))->{$method}();

//TODO: helper functions
function extractRequestBody($request_method):array{
    return match ($request_method){
        'POST' => $_POST,
        'GET' => $_GET, //[Array of inout values]
        default => throw new \Exception('Invalid request type')
    };
}

function getUserObject():?User{
    /**
     * TODO: When request is done by an authenticated user, then pass user object along with the request object.
     */
    return null;
}