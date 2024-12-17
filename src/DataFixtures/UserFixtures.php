<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class UserFixtures extends Fixture implements OrderedFixtureInterface
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher) {

    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('guillaume.couvidou@live.fr');
        $user->setUsername('guicouvi');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->passwordHasher->hashPassword($user, 'esgi'));
        $manager->persist($user);

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 1; // Chargée en premier
    }
}
