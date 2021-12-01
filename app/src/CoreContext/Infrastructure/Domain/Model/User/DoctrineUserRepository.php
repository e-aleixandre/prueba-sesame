<?php

namespace App\CoreContext\Infrastructure\Domain\Model\User;

use App\CoreContext\Domain\Model\User\UserRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use User;

class DoctrineUserRepository extends ServiceEntityRepository implements UserRepository
{
    public function save(User $user): void
    {
        $this->_em->persist($user);
    }
}