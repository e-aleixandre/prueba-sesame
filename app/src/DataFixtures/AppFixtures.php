<?php

namespace App\DataFixtures;

use App\Factory\UserFactory;
use App\Factory\WorkEntryFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createMany(10);

        WorkEntryFactory::createMany(40,
            function() {
                return [ 'user' => UserFactory::random() ];
            }
        );
    }
}
