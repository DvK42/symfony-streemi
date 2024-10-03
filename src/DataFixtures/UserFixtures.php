<?php

namespace App\DataFixtures;

use App\Entity\Media;
use App\Entity\Movie;
use App\Entity\Playlist;
use App\Entity\Subscription;
use App\Entity\User;
use App\Enum\MediaTypeEnum;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
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
}
