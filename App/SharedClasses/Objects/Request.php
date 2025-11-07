<?php namespace App\SharedClasses\Objects;


use App\SharedClasses\Enums\MethodsEnum;


class Request implements ObjectInterface
{
    public function __construct(
        public MethodsEnum $method,
        public ?User $user = null,
        public ?UserRequestObject $body = null
    )
    {
    }

    public function all():UserRequestObject{
        return $this->body;
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