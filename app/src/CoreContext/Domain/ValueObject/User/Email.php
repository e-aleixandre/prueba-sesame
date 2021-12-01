<?php

class Email
{
    private string $email;

    public function __construct(string $value)
    {
        $this->email = $value;
    }

    public static function validate(string $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL))
            throw new InvalidEmailException($value);
    }
}