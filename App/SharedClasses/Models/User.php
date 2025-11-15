<?php

namespace App\SharedClasses\Models;

class User extends BaseModel
{
    protected string $table = 'users';
    protected array $fillable = [
        'username',
        'email',
        'password',
        'firstname',
        'lastname',
        'phone_number',
        'dob'
    ];


}