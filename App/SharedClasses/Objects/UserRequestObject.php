<?php

namespace App\SharedClasses\Objects;

class UserRequestObject
{
    public function __construct(
        public ?string $username= null,
        public ?string $password= null,
        public ?string $firstname= null,
        public ?string $lastname= null,
        public ?string $phone_number= null,
        public ?string $dob = null,
        public ?string $confirm_password = null,
    )
    {
    }

    /**
     * TODO: address issues with testing static methods - this is a placeholder method.
     *
     * @param array $array
     * @return static
     */
    public static function fromArray(array $array):static
    {
        return new self(...$array);
    }

    public static function empty():bool{
        return false; //TODO: implement this or call it count
    }


}