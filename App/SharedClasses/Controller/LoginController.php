<?php

namespace App\SharedClasses\Controller;

use App\SharedClasses\Objects\Requests\LoginRequest;
use Exception;
use JetBrains\PhpStorm\NoReturn;


class LoginController
{
    /**
     * @throws Exception
     */
    public function __construct(public LoginRequest $request)
    {
        if(! $request->authorise() ) {
            dd('unauthorized');
        }

        $this->request->validator->run();
    }

    #[NoReturn]
    public function index(): void
    {

        if($this->request->validator->hasErrors()) {
            dd($this->request->validator->getErrors());
        }

        dd($this->request);
    }

}