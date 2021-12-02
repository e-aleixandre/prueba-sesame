<?php

namespace App\ddd\Infrastructure\ORM\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository as SfServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

abstract class ServiceEntityRepository extends SfServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, static::entityClassName());
    }

    abstract protected static function entityClassName(): string;
}
