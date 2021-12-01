<?php

class CreateUser
{
    private UserName $name;
    private Email $email;

    public function __construct(UserName $name, Email $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function name(): UserName
    {
        return $this->name;
    }

    public function email(): Email
    {
        return $this->email;
    }
}