<?php

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

$test = $userObject->empty() ? 'Empty' : 'Not empty';

//use empty like so: dd($test)

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

dd($validator->validateCustom());


//TODO: Date validation:

//1. Test that it's a valid date
//2. test that it's not more than a specific date -
//3. test that it's not less than a specific date'
//4. Test date is in the right format


//TODO: Tuesday / Wednesday - Routing
//TODO: Concept of middleware