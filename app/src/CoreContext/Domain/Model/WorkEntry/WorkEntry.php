<?php

namespace App\CoreContext\Domain\Model\WorkEntry;

use Carbon\CarbonImmutable;
use Ramsey\Uuid\Uuid;

class WorkEntry
{
    private string $id;
    private string $userId;
    private CarbonImmutable $startDate;
    private ?CarbonImmutable $endDate;
    private CarbonImmutable $createdAt;
    private CarbonImmutable $updatedAt;
    private ?CarbonImmutable $deletedAt;

    public function __construct(
        string $userId,
        CarbonImmutable $startDate,
        ?CarbonImmutable $endDate
    )
    {
        $this->id = Uuid::uuid4()->toString();
        $this->userId = $userId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->createdAt = $this->updatedAt = CarbonImmutable::now()->utc();
    }

    public function id(): string
    {
        return $this->id;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function startDate(): CarbonImmutable
    {
        return $this->startDate;
    }

    public function endDate(): ?CarbonImmutable
    {
        return $this->endDate;
    }

    public function createdAt(): CarbonImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): CarbonImmutable
    {
        return $this->updatedAt;
    }

    public function delete(): void
    {
        $this->deletedAt = $this->updatedAt = CarbonImmutable::now()->utc();

        // TODO: Dispatch WorkEntryDeleted event
    }

    public function update(CarbonImmutable $startDate, ?CarbonImmutable $endDate): void
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->updatedAt = CarbonImmutable::now()->utc();

        // TODO: Dispatch WorkEntryUpdated event
    }
}
