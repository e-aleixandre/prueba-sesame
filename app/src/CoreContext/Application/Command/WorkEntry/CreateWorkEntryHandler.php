<?php

namespace App\CoreContext\Application\Command\WorkEntry;

use App\CoreContext\Domain\Model\WorkEntry\WorkEntry;
use App\CoreContext\Domain\Model\WorkEntry\WorkEntryRepository;

class CreateWorkEntryHandler
{
    private WorkEntryRepository $workEntryRepository;

    public function __construct(WorkEntryRepository $workEntryRepository)
    {
        $this->workEntryRepository = $workEntryRepository;
    }

    public function handle(CreateWorkEntry $command): void
    {
        $workEntry = new WorkEntry(
          $command->userId(),
          $command->startDate(),
          $command->endDate()
        );

        $this->workEntryRepository->save($workEntry);
    }
}
