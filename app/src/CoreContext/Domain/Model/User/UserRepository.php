<?php

namespace App\CoreContext\Domain\Model\User;

interface UserRepository
{
    public function save(User $user): void;
    public function byId(string $id): ?User;
    /** @return User[] */
    public function query($params): array;
}
