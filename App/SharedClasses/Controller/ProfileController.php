<?php

namespace App\SharedClasses\Controller;

use App\SharedClasses\Enums\StatusCode;
use App\SharedClasses\Objects\Requests\ProfileRequest;
use App\SharedClasses\Objects\Response;

class ProfileController extends BaseController
{
    public function __construct(ProfileRequest $request)
    {
        parent::__construct($request);
    }

    public function index(){

        if($this->request->validator->hasErrors()) {
            (new Response(
                status: StatusCode::VALIDATION_ERROR, //TODO: SOMETIMES IT'S NOT VALIDATION ERROR
                statusCode: StatusCode::VALIDATION_ERROR(),
                message: 'Your submission has some errors, please fix',
                headers: [],
                body: $this->request->validator->getErrors()
            ))->dd();
        }

        (new Response(
            status: StatusCode::SUCCESS,
            statusCode: StatusCode::SUCCESS(),
            message: 'Profile updated',
            headers: [],
            body: $this->request->body()
        ))->dd();
    }
}