<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EtudiantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0, $i < 10, $i++) {
            // Créer un étudiant
            $etudiant = new Etudiant();
            $etudiant->setPrenom("personnage$i");
            // ...
            $manager->persist($etudiant);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
