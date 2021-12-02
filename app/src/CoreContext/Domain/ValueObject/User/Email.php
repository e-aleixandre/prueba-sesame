<?php

namespace App\CoreContext\Domain\ValueObject\User;

use App\ddd\Domain\Exception\InvalidEmailException;

class Email
{
    private string $email;

    public function __construct(string $value)
    {
        static::validate($value);
        $this->email = $value;
    }

    public static function validate(string $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL))
            throw new InvalidEmailException($value);
    }

    public function __toString()
    {
        return $this->email;
    }
}