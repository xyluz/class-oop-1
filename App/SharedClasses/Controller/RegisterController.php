<?php

namespace App\SharedClasses\Controller;

use App\SharedClasses\Enums\StatusCode;
use App\SharedClasses\Models\BaseModel;
use App\SharedClasses\Models\User;
use App\SharedClasses\Objects\Requests\RegisterRequest;
use App\SharedClasses\Objects\Response;

class RegisterController extends BaseController
{
    protected BaseModel $registerModel;
    public function __construct(RegisterRequest $request)
    {
        parent::__construct($request);
        $this->registerModel = new User();
    }

    public function index(){

        if($this->request->validator->hasErrors()) {
            (new Response(
                status: StatusCode::VALIDATION_ERROR,
                statusCode: StatusCode::VALIDATION_ERROR(),
                message: 'Your submission has some errors, please fix',
                headers: [],
                body: $this->request->validator->getErrors()
            ))->dd();
        }

        try{
            $modelAction = $this->registerModel->create($this->request->body->toArray());

            if($modelAction){
                //return response object or, set new active session // redirect to specific page - login, or dashboard
            }

        }catch (\Exception $e){
            (new Response(
                status: StatusCode::OTHERS,
                statusCode: StatusCode::OTHERS(),
                message: $e->getMessage(),
                headers: [],
                body: $this->request->validator->getErrors()
            ))->dd();
        }




        redirect('/dashboard'); //TODO: Display user details on the dashboard
    }
}