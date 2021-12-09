<?php

namespace App\CoreContext\Application\Query\WorkEntry;

use App\CoreContext\Domain\Model\WorkEntry\WorkEntry;
use App\CoreContext\Domain\Model\WorkEntry\WorkEntryRepository;

class FindWorkEntriesByUserHandler
{

    private WorkEntryRepository $workEntryRepository;

    public function __construct(WorkEntryRepository $workEntryRepository)
    {
        $this->workEntryRepository = $workEntryRepository;
    }

    /** @return WorkEntry[] */
    public function handle(FindWorkEntriesByUser $query): array
    {
        // TODO: Return a QueryResponse
        return $this->workEntryRepository->byUserId($query->userId());
    }
}