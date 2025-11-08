<?php

namespace App\SharedClasses\Objects\Requests;

use App\SharedClasses\Enums\MethodsEnum;
use App\SharedClasses\Objects\Request;
use App\SharedClasses\Objects\Role;
use App\SharedClasses\Objects\RulesCollection;
use App\SharedClasses\Objects\User;
use App\SharedClasses\Objects\UserRequestObject;
use App\SharedClasses\Validator;

class ProfileRequest extends Request implements RequestInterface
{

    public function authorise(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id'=>'must:numeric',
            'firstname' => 'should:alpha'
        ];

    }

}