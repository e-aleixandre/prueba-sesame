<?php

namespace App\ddd\Infrastructure\Validator;

abstract class BaseValidator implements BaseValidatorInterface
{
    private array $payload;

    private function __construct(array $payload)
    {

        $this->payload = $payload;
    }

    protected static function validate(array $payload): self
    {

    }

}
