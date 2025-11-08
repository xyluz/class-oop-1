<?php namespace App\SharedClasses\Objects;


use App\SharedClasses\Enums\MethodsEnum;
use App\SharedClasses\Validator;


class Request implements ObjectInterface
{
    public Validator $validator;

    public function __construct(
        public MethodsEnum $method,
        public ?User $user = null,
        public ?UserRequestObject $body = null
    )
    {
        $this->validator = new Validator(
            rulesCollection: new RulesCollection($this->rules()),
            inputObject: $this->body
        );
    }

    public function all():UserRequestObject{
        return $this->body;
    }

    public function body():array{
        return array_filter($this->body->toArray());
    }

    public function json():string {
        return json_encode($this->body->toArray());
    }

    public function user():User {
        return $this->user;
    }

    public function getMethod():MethodsEnum {
        return $this->method;
    }

    public function validated():bool{
        return true;
    }

    public function getName(): string
    {
        return __METHOD__ . '::' . __FUNCTION__; //Redundant
    }

}