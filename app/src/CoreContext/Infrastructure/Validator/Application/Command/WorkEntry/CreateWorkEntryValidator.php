<?php

namespace App\CoreContext\Infrastructure\Validator\Application\Command\WorkEntry;

use App\CoreContext\Infrastructure\Constraints\UserId;
use App\ddd\Infrastructure\Validator\BaseValidatorService;
use Symfony\Component\Validator\Constraints as Assert;

class CreateWorkEntryValidator extends BaseValidatorService
{
    private const USER_ID = 'userId';
    private const START_DATE = 'startDate';
    private const END_DATE = 'endDate';

    public function constraints(): Assert\Collection
    {
        return new Assert\Collection([
           self::USER_ID => [
               new Assert\NotNull(),
               new Assert\NotBlank(),
               new UserId()
           ],
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

    public function userId(): string
    {
        return $this->payload(self::USER_ID);
    }

    public function startDate(): string
    {
        return $this->payload(self::START_DATE);
    }

    public function endDate(): ?string
    {
        return $this->payload(self::END_DATE);
    }
}
