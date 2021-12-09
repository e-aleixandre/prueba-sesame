<?php

namespace App\ddd\Infrastructure\Validator;

use Illuminate\Validation\ValidationException;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class BaseValidatorService implements BaseValidatorInterface
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    abstract public function constraints(): Collection;

    public function validate($data): void
    {
        $validated = $this->validator->validate($data, $this->constraints());

        // TODO: Raise a different exception per violation
        if ($validated->count())
            throw new ValidatorException();
    }
}
