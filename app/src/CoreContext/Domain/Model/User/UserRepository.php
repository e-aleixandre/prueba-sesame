<?php

namespace App\CoreContext\Domain\Model\User;

interface UserRepository
{
    public function save(User $user): void;
}
