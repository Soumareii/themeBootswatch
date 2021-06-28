<?php

namespace App\DataFixtures;

use App\Entity\Announce;
use App\Entity\Comment;
use App\Entity\Image;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i = 0; $i < 30; $i++){
            $announce = new Announce();
            $announce->setTitle($faker->sentence(3, false));
            $announce->setIntroduction($faker->sentence());
            $announce->setDescription($faker->text(600));
            $announce->setPrice(mt_rand(30000, 60000));
            $announce->setAddress($faker->address());
            $announce->setCoverImage('https://picsum.photos/1300/600?random='.mt_rand(1,10000));
            $announce->setRooms(mt_rand(1, 5));
            $announce->setIsAvailable(mt_rand(0, 1));
            $announce->setCreatedAt($faker->dateTimeBetween('-3 month', 'now'));

            for($j = 0; $j < mt_rand(0, 7); $j++) {
                $comment = new Comment();
                $comment->setAuthor($faker->name())
                         ->setEmail($faker->email())
                         ->setContent($faker->text(200))
                         ->setCreatedAt($faker->dateTimeBetween('-3 week', 'now'))
                         ->setAnnounce($announce);
                $announce->addComment($comment);        
            }

            for($k = 0; $k < mt_rand(2, 7); $k++) {
                $image = new Image();
                $image->setImageUrl('https://picsum.photos/500/350?random='.mt_rand(1,50000))
                         ->setDescription($faker->sentence(3, false))
                         ->setAnnounce($announce);
                $announce->addImage($image);        
            }
    
            $manager->persist($announce);   // Permet à Doctrine d'enregistrer l'annonce dans la DB 
        }
        $manager->flush();  // Execute l'enregistrement des données persistées
    }
}
