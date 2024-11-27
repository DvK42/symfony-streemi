<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Faker\Factory;

class CategorieFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $categorie = new Categorie();
            $name = $faker->word(); 
            $categorie->setName(ucfirst($name));
            $categorie->setLabel(ucfirst($faker->sentence(2)));

            $manager->persist($categorie);
        }

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 3;
    }
}
