<?php

namespace App\CoreContext\Domain\Model\User;

use User;

interface UserRepository
{
    public function save(User $user): void;
}
