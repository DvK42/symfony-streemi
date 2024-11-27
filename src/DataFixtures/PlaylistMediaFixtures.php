<?php

namespace App\DataFixtures;

use App\Entity\PlaylistMedia;
use App\Entity\Playlist;
use App\Entity\Media; // Assurez-vous d'importer les bonnes entités
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PlaylistMediaFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Récupérer les playlists et les médias existants
        $playlists = $manager->getRepository(Playlist::class)->findAll();
        $medias = $manager->getRepository(Media::class)->findAll();

        if (empty($playlists) || empty($medias)) {
            throw new \RuntimeException('Vous devez charger des données pour Playlist et Media avant PlaylistMedia.');
        }

        for ($i = 0; $i < 20; $i++) {
            $playlistMedia = new PlaylistMedia();

            // Associer à une playlist aléatoire
            $playlistMedia->setPlaylist($faker->randomElement($playlists));

            // Associer à un media aléatoire
            $playlistMedia->setMedia($faker->randomElement($medias));

            // Définir d'autres propriétés si elles existent
            $playlistMedia->setAddedAt(new \DateTimeImmutable($faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s')));

            $manager->persist($playlistMedia);
        }

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 7;
    }
}
