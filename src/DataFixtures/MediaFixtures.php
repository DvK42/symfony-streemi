<?php

namespace App\DataFixtures;

use App\Entity\Media;
use App\Entity\Movie;
use App\Entity\Serie;
use App\Enum\MediaTypeEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class MediaFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $media = $this->createMedia();

            $media->setMediaType(MediaTypeEnum::PUBLISHED);
            $media->setTitle($faker->sentence(1));
            $media->setShortDescription($faker->sentence(10));
            $media->setLongDescription($faker->paragraphs(1, true));
            $media->setReleaseDate($faker->dateTimeBetween('-10 years', 'now'));

            //$movie = new Movie();

            //$movie->setMediaType(MediaTypeEnum::PUBLISHED);
            //$movie->setTitle($faker->sentence(1));
            //$movie->setShortDescription($faker->sentence(10));
            //$movie->setLongDescription($faker->paragraphs(1, true));
            //$movie->setReleaseDate($faker->dateTimeBetween('-10 years', 'now'));

            $manager->persist($media);
        }

        //for ($i = 0; $i < 50; $i++) {
        //    $serie = new Serie();
//
        //    $serie->setMediaType(MediaTypeEnum::PUBLISHED);
        //    $serie->setTitle($faker->sentence(1));
        //    $serie->setShortDescription($faker->sentence(10));
        //    $serie->setLongDescription($faker->paragraphs(1, true));
        //    $serie->setReleaseDate($faker->dateTimeBetween('-10 years', 'now'));
//
        //    $manager->persist($serie);
        //}

        $manager->flush();
    }
    private function createMedia(){
        $faker = Factory::create();

        $boolean = $faker->boolean();
        if(!$boolean){
            $media = new Movie();
        }else{
            $media = new Serie();
        }
        return $media;
    }
}
