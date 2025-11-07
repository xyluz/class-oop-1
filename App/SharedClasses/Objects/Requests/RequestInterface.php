<?php

namespace App\SharedClasses\Objects\Requests;

interface RequestInterface
{
    public function authorise(): bool;
    public function rules():array;
}