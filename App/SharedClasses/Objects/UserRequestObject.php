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
     *
     * @param array $array
     * @return static
     */
    public static function fromArray(array $array):static
    {
        return new self(...$array);
    }

    public function empty():bool{
        return empty($this->username) && empty($this->lastname) && empty($this->firstname);
    }

}