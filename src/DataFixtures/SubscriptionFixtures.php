<?php

namespace App\DataFixtures;

use App\Entity\Subscription;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

use Faker\Factory;

class SubscriptionFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $subscription = new Subscription();
            $subscription->setName($faker->word);
            $subscription->setPrice($faker->randomFloat(2, 5, 100));
            $subscription->setDurationInMonths($faker->numberBetween(1, 12));
            $manager->persist($subscription);
        }

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 6;
    }
}
