<?php

namespace App\DataFixtures;

use App\Factory\AnoncesFactory;
use App\Factory\QuestionsAnoncesFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createMany(10);
        AnoncesFactory::createMany(60);
        QuestionsAnoncesFactory::createMany(120);
    }
}
