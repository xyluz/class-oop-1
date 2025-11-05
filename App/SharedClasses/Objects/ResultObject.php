<?php

namespace App\SharedClasses\Objects;

use App\SharedClasses\Enums\StatusCode;

class ResultObject
{
    public function __construct(
        public string $message = '',
        public array $data = [],
        public ?StatusCode $statusCode = StatusCode::SUCCESS
    )
    {
    }

    public function isFailure(): bool
    {
        return $this->statusCode !== StatusCode::SUCCESS;
    }

    public function isSuccess(): bool
    {
        return $this->statusCode === StatusCode::SUCCESS;
    }

    public function getData(): array {
        return $this->data;
    }

    public function getMessage(): string {
        return $this->message;
    }

    public function getStatusCode():int {
        return $this->statusCode->value;
    }

    public function getSummary(){
        return "message: " . $this->getMessage() . " status: " . $this->getStatusCode();
    }
}