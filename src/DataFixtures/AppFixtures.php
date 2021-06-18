<?php

namespace App\DataFixtures;

use App\Entity\Announce;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 0; $i < 20; $i++){
            $announce = new Announce();
            $announce->setTitle("chambre n°$i");
            $announce->setSlug("chambre-$i");
            $announce->setDescription("Je vos loue ma chambre avec salle de bain neuve ... d");
            $announce->setPrice(mt_rand(30000, 60000));
            $announce->setAddress("Médina Rue 12");
            $announce->setCoverImage("https://via.placeholder.com/500x300");
            $announce->setRooms(mt_rand(0, 5));
            $announce->setIsAvailable(mt_rand(0, 1));
            $announce->setCreatedAt(new DateTime());
    
            $manager->persist($announce);   // Permet à Doctrine d'enregistrer l'annonce dans la DB 
        }

        $manager->flush();  // Execute l'enregistrement des données persistées

    }
}
