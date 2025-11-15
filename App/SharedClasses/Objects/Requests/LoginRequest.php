<?php

namespace App\SharedClasses\Objects\Requests;

use App\SharedClasses\Enums\MethodsEnum;
use App\SharedClasses\Objects\Request;
use App\SharedClasses\Objects\RulesCollection;
use App\SharedClasses\Objects\User;
use App\SharedClasses\Objects\UserRequestObject;
use App\SharedClasses\Validator;

class LoginRequest extends Request implements RequestInterface
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
            'username'=>'min:3|max:5|must:alpha',
            'password'=> "min:8|max:50|should:alpha|should:uppercase|should:lowercase|should:numeric|should:special_character",
        ];

    }
}