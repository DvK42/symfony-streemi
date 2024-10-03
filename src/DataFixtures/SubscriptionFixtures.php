<?php

namespace App\DataFixtures;

use App\Entity\Subscription;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SubscriptionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $subscription = new Subscription();
            $subscription->setName($faker->word() . ' Plan'); // Nom aléatoire
            $subscription->setDurationInMonths($faker->numberBetween(1, 12)); // Durée entre 1 et 12 mois
            $subscription->setPrice($faker->randomFloat(2, 5, 100)); // Prix entre 5 et 100

            $manager->persist($subscription);
        }

        $manager->flush();
    }
}
