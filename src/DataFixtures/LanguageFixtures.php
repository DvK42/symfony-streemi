<?php

namespace App\DataFixtures;

use App\Entity\Language;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class LanguageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $language = new Language();
            $name = $faker->word();
            $language->setName(ucfirst($name)); // Mettre la première lettre en majuscule
            
            // Générer le code à partir des deux premières lettres du nom
            $code = strtoupper(substr($name, 0, 2)); // Les deux premières lettres en majuscules
            $language->setCode($code);

            $manager->persist($language);
        }

        $manager->flush();
    }
}
