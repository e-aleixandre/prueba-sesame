<?php

namespace App\CoreContext\Domain\Event\User;

use App\ddd\Domain\DomainEvent;
use Carbon\CarbonImmutable;

class UserDeleted implements DomainEvent
{

    private string $userId;
    private CarbonImmutable $occurredOn;

    public function __construct(string $userId)
    {
        $this->userId = $userId;
        $this->occurredOn = CarbonImmutable::now()->utc();
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function occurredOn(): CarbonImmutable
    {
        return $this->occurredOn;
    }
}
