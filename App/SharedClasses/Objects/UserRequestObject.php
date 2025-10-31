<?php

namespace App\SharedClasses\Objects;

class UserRequestObject
{
    public function __construct(
        public string $username,
        public string $password,
        public string $confirm_password,
        public string $firstname,
        public string $lastname,
        public string $phone_number,
        public string $dob,
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