<?php

namespace App\DataFixtures;

use App\Entity\PlaylistSubscription;
use App\Entity\Playlist;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PlaylistSubscriptionFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Récupérer les utilisateurs et les playlists existants
        $users = $manager->getRepository(User::class)->findAll();
        $playlists = $manager->getRepository(Playlist::class)->findAll();

        if (empty($users) || empty($playlists)) {
            throw new \RuntimeException('Vous devez charger des données pour User et Playlist avant PlaylistSubscription.');
        }

        // Stockage des souscriptions pour éviter les doublons
        $subscriptions = [];

        for ($i = 0; $i < 20; $i++) {
            $user = $faker->randomElement($users);
            $playlist = $faker->randomElement($playlists);

            // Vérifier si la souscription existe déjà
            $subscriptionKey = sprintf('%s-%s', $user->getId(), $playlist->getId());
            if (isset($subscriptions[$subscriptionKey])) {
                // Ignorer si l'utilisateur est déjà abonné à cette playlist
                continue;
            }

            $playlistSubscription = new PlaylistSubscription();
            $playlistSubscription->setUser($user);
            $playlistSubscription->setPlaylist($playlist);
            $playlistSubscription->setSubscribedAt(new \DateTimeImmutable($faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s')));

            // Marquer la souscription comme existante
            $subscriptions[$subscriptionKey] = true;

            $manager->persist($playlistSubscription);
        }

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 8;
    }
}
