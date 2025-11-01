<?php

use App\SharedClasses\Enums\Constraints;
use App\SharedClasses\Enums\Rules;
use App\SharedClasses\Objects\RuleObject;
use App\SharedClasses\Objects\RulesCollection;
use App\SharedClasses\Objects\SingleRuleCollection;
use App\SharedClasses\Objects\UserRequestObject;
use App\SharedClasses\Validator;


require 'vendor/autoload.php';

//$userObject =  UserRequestObject::fromArray([
//
//        'firstname' => 'Seyi4433',
//
//]);


$userObject =  UserRequestObject::fromArray([
    'username' => 'SeyiOnifade',
    'password' => 'password&',
    'firstname' => 'E',
    'lastname' => 'P',
    'phone_number' => '0123456789'
]);
//
$rules = [
    'phone_number'=> "min:11|max:15|must:numeric",
    'firstname'=>'min:3|max:200|must:alpha|not:numeric',
    'lastname'=>'min:3|max:200|must:alpha|not:numeric',
    'username'=>'min:3|max:5|must:alpha',
    'password'=>'min:8|max:50|should:alpha_numeric|should:uppercase|should:lowercase|should:symbol'
];

//$rules = [
//    'firstname'=>'not:numeric|max:5',
//
//];


$validator = new Validator(
    rulesCollection: new RulesCollection($rules),
    inputObject: $userObject
);

dd($validator->validateCustom(), true);



