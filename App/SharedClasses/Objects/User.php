<?php namespace App\SharedClasses\Objects;


class User implements ObjectInterface
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public string $password,
        public Role $role,
        public bool $status = false
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRole(): Role
    {
        return $this->role;
    }

    public function authorised():bool {
        return false;
    }
}