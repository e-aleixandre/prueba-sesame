<?php

namespace App\CoreContext\Domain\Model\WorkEntry;

interface WorkEntryRepository
{
    public function save(WorkEntry $workEntry): void;
    public function byId(string $id): ?WorkEntry;
    /** @return WorkEntry[] */
    public function byUserId(string $userId): array;
    /** @return WorkEntry[] */
    public function query($params): array;
}
