<?php

namespace App\CoreContext\Infrastructure\Constraints;

use App\CoreContext\Domain\Model\User\UserRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class UserIdValidator extends ConstraintValidator
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof UserId)
            throw new UnexpectedTypeException($constraint, UserId::class);

        if (null === $value || '' === $value)
            return;

        $count = $this->userRepository->exists($value);

        if (!$count)
        {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
