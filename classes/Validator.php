<?php

require 'Errors.php';

class Validator
{
    private $errors;

    public function __construct()
    {
        $this->errors = new Errors;
    }

    // Check if an input fields are empty
    public function required(string $key, $value): void
    {
        if (empty($value)) {
            $this->errors->add($key, ucwords($key) . " is required.");
        }
    }

    // Check if an input value is a number
    public function number(string $key, $value): void
    {
        if (!is_numeric($value)) {
            $this->errors->add($key, ucwords($key) . " should be a number.");
        }
    }

    // Check if there are no validation errors
    public function success(): bool
    {
        return $this->errors->count() === 0;
    }

    // Get errors as an array
    public function getErrors()
    {
        return $this->errors;
    }
}