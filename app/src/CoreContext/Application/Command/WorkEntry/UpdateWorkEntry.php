<?php

namespace App\CoreContext\Application\Command\WorkEntry;

use Carbon\CarbonImmutable;

class UpdateWorkEntry
{
    private string $id;
    private string $startDate;
    private ?string $endDate;

    public function __construct(string $id, string $startDate, ?string $endDate)
    {
        $this->id = $id;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function id(): string
    {
        return $this->id;
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
