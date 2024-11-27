<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('guillaume.couvidou@live.fr');
        $user->setUsername('guicouvi');
        $user->setPassword('esgi');
        $manager->persist($user);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 1; // Chargée en premier
    }
}
