<?php namespace App\SharedClasses\Objects;

use App\SharedClasses\Enums\StatusCode;
use JetBrains\PhpStorm\NoReturn;


class Response implements ObjectInterface
{
    public function __construct(
        public StatusCode $status,
        public int $statusCode,
        public string $message = '',
        public array $headers = [],
        public array $body = [],
    )
    {
    }

    public function getStatus(): StatusCode {
        return $this->status;
    }

    public function getStatusCode(): int {
        return $this->statusCode;
    }

    public function getContent(): array
    {
        return $this->body;
    }

    private function getHeaders(): array
    {
        return $this->headers;
    }

    #[NoReturn]
    public function dd(): void
    {
        dd(var: [
            'status'=>$this->status,
            'statusCode'=>$this->getStatusCode(),
            'message'=>$this->message,
            'headers'=>$this->getHeaders(),
            'body'=>$this->getContent()
        ]);
    }


    public function getName(): string
    {
        // TODO: Implement getName() method.
    }
}