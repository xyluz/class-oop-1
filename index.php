<?php

use App\SharedClasses\Objects\RulesObject;
use App\SharedClasses\Objects\UserRequestObject;
use App\SharedClasses\Validator;


require 'vendor/autoload.php';

$userObject =  UserRequestObject::fromArray([
        'username' => 'SeyiOnifade',
        'password' => 'password',
        'confirm_password' => 'password',
        'firstname' => 'Seyi',
        'lastname' => 'Onifade',
        'phone_number' => '0123456789',
        'dob' => '12/43/98'
]);


$validator = new Validator(
    rules: new RulesObject(),
    inputObject: $userObject
);

dd($validator, true);


echo 'something else';

