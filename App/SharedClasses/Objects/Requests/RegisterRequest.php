<?php

namespace App\SharedClasses\Objects\Requests;

use App\SharedClasses\Enums\MethodsEnum;
use App\SharedClasses\Objects\Request;
use App\SharedClasses\Objects\Role;
use App\SharedClasses\Objects\RulesCollection;
use App\SharedClasses\Objects\User;
use App\SharedClasses\Objects\UserRequestObject;
use App\SharedClasses\Validator;


class RegisterRequest extends Request implements RequestInterface
{

    public Validator $validator;

    public function __construct(MethodsEnum $method, ?User $user = null, ?UserRequestObject $body = null)
    {
        parent::__construct(method: $method, user: $user, body: $body);

        $this->validator = new Validator(
            rulesCollection: new RulesCollection($this->rules()),
            inputObject: $this->body
        );
    }

    public function authorise(): bool
    {
//        return $this->user->role === 'admin'
        return true;
    }

    public function rules(): array
    {

        return [
            'firstname'=>'min:3|max:200|must:alpha|not:numeric',
            'lastname'=>'min:3|max:200|must:alpha|not:numeric',
            'username'=>'min:3|max:5|must:alpha',
            'phone'=>'min:11|max:15|must:numeric',
            'password'=> "min:8|max:50|should:alpha|should:uppercase|should:lowercase|should:numeric|should:special_character",
        ];

    }

}