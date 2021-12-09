<?php

namespace App\CoreContext\Infrastructure\Validator\Application\Command\User;

use App\ddd\Infrastructure\Validator\BaseValidatorService;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateUserValidator extends BaseValidatorService
{
    private const NAME = 'name';
    private const EMAIL = 'email';

    public function constraints(): Assert\Collection
    {
        return new Assert\Collection([
            self::NAME => [
                new Assert\NotBlank()
            ],
            self::EMAIL => [
                new Assert\NotBlank(),
                new Assert\Email()
            ]
        ]);
    }
}