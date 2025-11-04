<?php

if(!defined('ROOT_DIR')) define('ROOT_DIR', realpath(__DIR__));

include_once("routes/slash.route.php");

use App\SharedClasses\Objects\RulesCollection;
use App\SharedClasses\Objects\UserRequestObject;
use App\SharedClasses\Validator;


require 'vendor/autoload.php';

$userObject =  UserRequestObject::fromArray([
    'password' => 'A',
    'username' => '',
    'firstname' => '',
    'lastname' => '',
    'phone_number' => '0846587392'
]);


$rules = [
    'firstname'=>'min:3|max:200|must:alpha|not:numeric',
    'lastname'=>'min:3|max:200|must:alpha|not:numeric',
    'username'=>'min:3|max:5|must:alpha',
    'phone'=>'min:11|max:15|must:numeric',
    'password'=> "min:8|max:50|should:alpha|should:uppercase|should:lowercase|should:numeric|should:special_character",
];

$validator = new Validator(
    rulesCollection: new RulesCollection($rules),
    inputObject: $userObject
);

try {
    dd($validator->run());
} catch (Exception $e) {
    dd($e->getMessage());
}


//TODO: Date validation:

//1. Test that it's a valid date
//2. test that it's not more than a specific date -
//3. test that it's not less than a specific date'
//4. Test date is in the right format


//TODO: Tuesday / Wednesday - Routing
//TODO: Concept of middleware


//-> type an address: google.com
//-> DNS Server -> google -> 142.251.30.138
//-> 142.251.30.138 -> GET /?search="value"
//(middleware)
//    -> to journey: when the request comes from user to the server
//    ->from journey: when the server sends request back to the user
//-> 142.251.30.138 -> / -> homepage.php
//-> homepage.php $search=value => DB: find records that match the value -> send that back to the server.
//-> 200/201 (Read about response codes) -> $data -> $data
