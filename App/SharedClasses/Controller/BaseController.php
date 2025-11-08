<?php

namespace App\SharedClasses\Controller;

use App\SharedClasses\Objects\Request;
use App\SharedClasses\Objects\Requests\RequestInterface;

class BaseController
{

    public function __construct(public RequestInterface $request)
    {
        if(! $this->request->authorise() ) {
            dd('unauthorized');
        }

        $this->request->validator->run();
    }

    public function index(){
        //this is the parent index
    }
}