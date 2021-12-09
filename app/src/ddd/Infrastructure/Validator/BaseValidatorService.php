<?php

namespace App\ddd\Infrastructure\Validator;

use Symfony\Component\Validator\Constraints\Collection;
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

        if ($validated->count())
        {
            $violation = $validated->get(0);
            $message = $violation->getPropertyPath() . ": " . $violation->getMessage();
            throw new ValidatorException($message);
        }
    }
}
