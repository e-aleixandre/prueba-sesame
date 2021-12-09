<?php

namespace App\CoreContext\Application\Query\WorkEntry;

class FindWorkEntriesByUser
{
    private string $userId;

    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }

    public function userId(): string
    {
        return $this->userId;
    }
}