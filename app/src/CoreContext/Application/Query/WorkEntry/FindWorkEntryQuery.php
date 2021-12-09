<?php

namespace App\CoreContext\Application\Query\WorkEntry;

class FindWorkEntryQuery
{
    private string $workEntryId;

    public function __construct(string $workEntryId)
    {
        $this->workEntryId = $workEntryId;
    }

    public function workEntryId(): string
    {
        return $this->workEntryId;
    }
}
