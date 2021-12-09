<?php

namespace App\CoreContext\Application\Query\WorkEntry;

use App\CoreContext\Domain\Exception\WorkEntry\WorkEntryNotFoundException;
use App\CoreContext\Domain\Model\WorkEntry\WorkEntry;
use App\CoreContext\Domain\Model\WorkEntry\WorkEntryRepository;

class FindWorkEntryQueryHandler
{
    private WorkEntryRepository $workEntryRepository;

    public function __construct(WorkEntryRepository $workEntryRepository)
    {
        $this->workEntryRepository = $workEntryRepository;
    }

    public function handle(FindWorkEntryQuery $query): WorkEntry
    {
        $workEntry = $this->workEntryRepository->byId($query->workEntryId());

        if (null === $workEntry)
            throw new WorkEntryNotFoundException($query->workEntryId());

        // TODO: return a QueryResponse
        return $workEntry;
    }
}
