<?php

class UserName
{
    private string $name;

    public function __construct(string $name)
    {
        $this->$name = $name;
    }

    public static function validate(string $name)
    {
        $nameLength = strlen($name);

        if ($nameLength < 3 || $nameLength > 255)
            throw new InvalidUserNameException($name);
    }
}