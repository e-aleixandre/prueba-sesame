<?php

namespace App\ddd\Infrastructure\Validator;

interface BaseValidatorInterface
{
    public static function validateBy(): self;
    public static function collection(string ...$notIncludes): Collection;
    public static function getConstraints(): array;
}