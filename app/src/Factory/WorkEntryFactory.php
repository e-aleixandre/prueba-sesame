<?php

namespace App\Factory;

use App\Entity\WorkEntry;
use App\Repository\WorkEntryRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<WorkEntry>
 *
 * @method static WorkEntry|Proxy createOne(array $attributes = [])
 * @method static WorkEntry[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static WorkEntry|Proxy find(object|array|mixed $criteria)
 * @method static WorkEntry|Proxy findOrCreate(array $attributes)
 * @method static WorkEntry|Proxy first(string $sortedField = 'id')
 * @method static WorkEntry|Proxy last(string $sortedField = 'id')
 * @method static WorkEntry|Proxy random(array $attributes = [])
 * @method static WorkEntry|Proxy randomOrCreate(array $attributes = [])
 * @method static WorkEntry[]|Proxy[] all()
 * @method static WorkEntry[]|Proxy[] findBy(array $attributes)
 * @method static WorkEntry[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static WorkEntry[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static WorkEntryRepository|RepositoryProxy repository()
 * @method WorkEntry|Proxy create(array|callable $attributes = [])
 */
final class WorkEntryFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        $date = self::faker()->dateTime();
        $now = new \DateTime();
        $ended = self::faker()->boolean();

        $workEntry = [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'updatedAt' => $now,
            'createdAt' => $now
        ];

        if ($ended) {
            $workEntry['endDate'] = $date;
            $workEntry['startDate'] = self::faker()->dateTime($date);
        } else {
            $workEntry['startDate'] = $date;
        }

        return $workEntry;
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(WorkEntry $workEntry) {})
        ;
    }

    protected static function getClass(): string
    {
        return WorkEntry::class;
    }
}
