<?php

namespace App\CoreContext\Application\Query\WorkEntry;

use App\CoreContext\Domain\Model\WorkEntry\WorkEntry;
use App\CoreContext\Domain\Model\WorkEntry\WorkEntryRepository;

class FindWorkEntriesQueryHandler
{

    private WorkEntryRepository $workEntryRepository;

    public function __construct(WorkEntryRepository $workEntryRepository)
    {
        $this->workEntryRepository = $workEntryRepository;
    }

    /** @return WorkEntry[] */
    public function handle(FindWorkEntriesQuery $query): array
    {
        // TODO: Return a QueryResponse
        return $this->workEntryRepository->query($query);
    }
}
