<?php

namespace App\CoreContext\Application\Command\WorkEntry;

use App\CoreContext\Domain\Exception\WorkEntry\WorkEntryNotFoundException;
use App\CoreContext\Domain\Model\WorkEntry\WorkEntryRepository;

class DeleteWorkEntryHandler
{
    private WorkEntryRepository $workEntryRepository;

    public function __construct(WorkEntryRepository $workEntryRepository)
    {
        $this->workEntryRepository = $workEntryRepository;
    }

    public function handle(DeleteWorkEntry $command): void
    {
        $workEntry = $this->workEntryRepository->byId($command->id());

        if (null === $workEntry)
            throw new WorkEntryNotFoundException($command->id());

        $workEntry->delete();
        $this->workEntryRepository->save($workEntry);
    }
}
