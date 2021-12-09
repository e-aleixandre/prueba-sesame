<?php

namespace App\CoreContext\Application\Command\WorkEntry;

use Carbon\CarbonImmutable;

class CreateWorkEntry
{
    private string $userId;
    private string $startDate;
    private ?string $endDate;

    public function __construct(string $userId, string $startDate, ?string $endDate)
    {
        $this->userId = $userId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function startDate(): CarbonImmutable
    {
        return CarbonImmutable::parse($this->startDate);
    }

    public function endDate(): ?CarbonImmutable
    {
        return $this->endDate ? CarbonImmutable::parse($this->endDate) : null;
    }
}
