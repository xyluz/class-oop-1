<?php namespace App\SharedClasses\Objects;


class Role implements ObjectInterface
{
    public function __construct(
        public string $name,
        public string $description,
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }



}