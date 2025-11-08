<?php

namespace App\SharedClasses\Objects\Requests;

use App\SharedClasses\Enums\MethodsEnum;
use App\SharedClasses\Objects\Request;
use App\SharedClasses\Objects\Role;
use App\SharedClasses\Objects\RulesCollection;
use App\SharedClasses\Objects\User;
use App\SharedClasses\Objects\UserRequestObject;
use App\SharedClasses\Validator;

class LoginRequest extends Request implements RequestInterface
{

    public function authorise(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'=>'min:3|max:50|should:alpha|should:special_character',
            'password'=> "min:8|max:50", //TODO: This is added so that password is required
        ];

    }

}