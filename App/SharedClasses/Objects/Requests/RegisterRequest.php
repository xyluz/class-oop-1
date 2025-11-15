<?php

namespace App\SharedClasses\Objects\Requests;

use App\SharedClasses\Objects\Request;


class RegisterRequest extends Request implements RequestInterface
{

    public function authorise(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'firstname'=>'min:3|max:200|must:alpha|not:numeric',
            'email'=>'min:3|max:200|should:special_character',
            'lastname'=>'min:3|max:200|must:alpha|not:numeric',
            'username'=>'min:3|max:200|must:alpha',
            'phone'=>'min:11|max:15|must:numeric',
//            'password'=> "min:8|max:50|should:alpha|should:uppercase|should:lowercase|should:numeric|should:special_character",
            'password'=> "min:5|max:50|should:alpha|should:uppercase",
        ];

    }

}