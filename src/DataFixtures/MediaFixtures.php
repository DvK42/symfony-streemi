<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use App\Entity\Media;
use App\Entity\Movie;
use App\Entity\Season;
use App\Entity\Serie;
use App\Enum\MediaTypeEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Faker\Factory;

class MediaFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $media = $this->createMedia($manager);

            $media->setTitle($faker->sentence(1));
            $media->setShortDescription($faker->sentence(10));
            $media->setLongDescription($faker->paragraphs(1, true));
            $media->setReleaseDate($faker->dateTimeBetween('-10 years', 'now'));

            $manager->persist($media);
        }

        $manager->flush();
    }

    private function createMedia(ObjectManager $manager){
        $faker = Factory::create();

        $boolean = $faker->boolean();
        if(!$boolean){
            $media = new Movie();
        }else{
            $media = new Serie();
            
            $numberOfSeasons = $faker->numberBetween(1, 5); // Nombre de saisons par série
            for ($seasonNumber = 1; $seasonNumber <= $numberOfSeasons; $seasonNumber++) {
                $season = new Season();
                $season->setSeasonNumber($seasonNumber);
                $season->setSerie($media);

                $numberOfEpisodes = $faker->numberBetween(5, 20); // Nombre d'épisodes par saison
                for ($episodeNumber = 1; $episodeNumber <= $numberOfEpisodes; $episodeNumber++) {
                    $episode = new Episode();
                    $episode->setTitle($faker->sentence(3));
                    $episode->setReleaseDate($faker->dateTimeBetween('-10 years', 'now'));
                    $episode->setDuration($faker->numberBetween(60, 180));
                    $episode->setSeason($season);

                    $manager->persist($episode); // Persister les épisodes
                }

                $manager->persist($season); // Persister les saisons
            }
        }

        return $media;
    }

    public function getOrder(): int
    {
        return 3;
    }
}
