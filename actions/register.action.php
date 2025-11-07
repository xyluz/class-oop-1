<?php

use App\SharedClasses\Objects\RulesCollection;
use App\SharedClasses\Objects\UserRequestObject;
use App\SharedClasses\Validator;

$rules = [
    'firstname'=>'min:3|max:200|must:alpha|not:numeric',
    'lastname'=>'min:3|max:200|must:alpha|not:numeric',
    'username'=>'min:3|max:5|must:alpha',
    'phone'=>'min:11|max:15|must:numeric',
    'password'=> "min:5|max:50|should:alpha|should:uppercase",
//    'password'=> "min:8|max:50|should:alpha|should:uppercase|should:lowercase|should:numeric|should:special_character",
];


$validator = (new Validator(
    rulesCollection: new RulesCollection($rules),
    inputObject:  UserRequestObject::fromArray($_POST)
));

try {
    $validator->run();
} catch (Exception $e) {
    dd($e->getMessage());
}

if($validator->hasErrors()){
    //TODO: Redirect them to login page. or register page, and show the errors on the page.
    dd($validator->getErrors());
}

redirect('/dashboard');



