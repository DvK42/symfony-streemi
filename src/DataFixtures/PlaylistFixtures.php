<?php

namespace App\DataFixtures;

use App\Entity\Playlist;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Faker\Factory;

class PlaylistFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $users = $manager->getRepository(User::class)->findAll();

        for ($i = 0; $i < 20; $i++) {
            $playlist = new Playlist();
            $playlist->setName($faker->sentence(2)); // Nom de la playlist
            $playlist->setCreatedAt(new \DateTimeImmutable($faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s')));
            $playlist->setUpdatedAt(new \DateTimeImmutable($faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s')));

            if (!empty($users)) {
                $playlist->setUser($faker->randomElement($users));
            }

            $manager->persist($playlist);
        }


        $manager->flush();
    }

        public function getOrder(): int
    {
        return 5;
    }
}
