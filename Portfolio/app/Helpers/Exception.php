<?php

use Exception as BaseException;

class CustomException extends BaseException {
    public function __construct(string $message = '', private array $data = [])
    {
        parent::__construct($message);
    }

    public function getData(): array
    {
        return $this->data;
    }
}