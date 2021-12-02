<?php

namespace App\CoreContext\Infrastructure\Domain\Model\User;

use App\CoreContext\Domain\Model\User\User;
use App\CoreContext\Domain\Model\User\UserRepository;
use App\ddd\Infrastructure\ORM\Repository\ServiceEntityRepository;

class DoctrineUserRepository extends ServiceEntityRepository implements UserRepository
{
    public function save(User $user): void
    {
        $this->_em->persist($user);
        $this->_em->flush();
    }

    protected static function entityClassName(): string
    {
        return User::class;
    }
}