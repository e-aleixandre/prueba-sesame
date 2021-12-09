<?php

namespace App\CoreContext\Application\Command\WorkEntry;

use App\CoreContext\Domain\Exception\WorkEntry\WorkEntryNotFoundException;
use App\CoreContext\Domain\Model\WorkEntry\WorkEntryRepository;

class UpdateWorkEntryHandler
{
    private WorkEntryRepository $workEntryRepository;

    public function __construct(WorkEntryRepository $workEntryRepository)
    {
        $this->workEntryRepository = $workEntryRepository;
    }

    public function handle(UpdateWorkEntry $command): void
    {
        $workEntry = $this->workEntryRepository->byId($command->id());

        if (null === $workEntry)
            throw new WorkEntryNotFoundException($command->id());

        $workEntry->update($command->startDate(), $command->endDate());

        $this->workEntryRepository->save($workEntry);
    }
}
