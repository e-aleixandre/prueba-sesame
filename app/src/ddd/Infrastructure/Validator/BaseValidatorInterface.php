<?php

namespace App\ddd\Infrastructure\Validator;
use Symfony\Component\Validator\Constraints\Collection;

interface BaseValidatorInterface
{
    public function constraints(): Collection;
    public function validate($data): void;
}
