<?php

namespace App\CoreContext\Infrastructure\Domain\Model\WorkEntry;

use App\CoreContext\Domain\Model\WorkEntry\WorkEntry;
use App\CoreContext\Domain\Model\WorkEntry\WorkEntryRepository;
use App\ddd\Infrastructure\ORM\Repository\ServiceEntityRepository;

class DoctrineWorkEntryRepository extends ServiceEntityRepository implements WorkEntryRepository
{

    public function save(WorkEntry $workEntry): void
    {
        $this->_em->persist($workEntry);
        $this->_em->flush();
    }

    public function byId(string $id): ?WorkEntry
    {
        return $this->find($id);
    }

    public function query($params): array
    {
        // TODO: Handle query params
        return $this->createQueryBuilder('workentry')
            ->andWhere('workentry.deletedAt IS NULL')
            ->getQuery()->getResult();
    }

    protected static function entityClassName(): string
    {
        return WorkEntry::class;
    }

    public function byUserId(string $userId): array
    {
        return $this->createQueryBuilder('workentry')
            ->andWhere('workentry.userId = :userId')
            ->andWhere('workentry.deletedAt IS NULL')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getResult();
    }
}
