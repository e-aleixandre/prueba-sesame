<?php

namespace App\CoreContext\Infrastructure\Validator\Application\Command\WorkEntry;

use App\ddd\Infrastructure\Validator\BaseValidatorService;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateWorkEntryValidator extends BaseValidatorService
{
    private const START_DATE = 'startDate';
    private const END_DATE = 'endDate';

    public function constraints(): Assert\Collection
    {
        return new Assert\Collection([
            self::START_DATE => [
                new Assert\NotNull(),
                new Assert\NotBlank(),
                new Assert\DateTime()
            ],
            self::END_DATE => [
                new Assert\Optional([
                    new Assert\NotBlank(),
                    new Assert\DateTime()
                ])
            ]
        ]);
    }
}
