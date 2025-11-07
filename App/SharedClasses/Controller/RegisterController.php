<?php

namespace App\SharedClasses\Controller;

use App\SharedClasses\Objects\Requests\RegisterRequest;

class RegisterController
{
    public function __construct(public RegisterRequest $request)
    {
        if(! $request->authorise() ) {
            dd('unauthorized');
        }

        $this->request->validator->run();
    }

    public function index(){

        if($this->request->validator->hasErrors()) {
            dd($this->request->validator->getErrors());
        }

        dd($this->request);
    }
}