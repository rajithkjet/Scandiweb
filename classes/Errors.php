<?php

class Errors
{
    private $errorsBag;

    public function add(string $key, string $errorMessage)
    {
        $this->errorsBag[$key][] = $errorMessage;
    }

    // Count the number of errors made during the validation
    public function count(): int
    {
        return count($this->errorsBag);
    }

    // Get the first error from an array of errors if there are any
    public function first(string $key): string
    {
        return $this->errorsBag[$key] ? $this->errorsBag[$key][0] : null;
    }

    // Check if an array of errors has a specific key
    public function has(string $key): bool
    {
        return isset($this->errorsBag[$key]);
    }
}