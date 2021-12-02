<?php

namespace App\CoreContext\Domain\ValueObject\User;

use App\CoreContext\Domain\Exception\User\InvalidUserNameException;

class UserName
{
    private string $name;

    public function __construct(string $name)
    {
        static::validate($name);
        $this->$name = $name;
    }

    public static function validate(string $name)
    {
        $nameLength = strlen($name);

        if ($nameLength < 3 || $nameLength > 255)
            throw new InvalidUserNameException($name);
    }

    public function __toString()
    {
        return $this->name;
    }
}