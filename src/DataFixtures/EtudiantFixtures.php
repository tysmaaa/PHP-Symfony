<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EtudiantFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Créer un objet faker
        $faker = Factory::create("fr_FR");
        // Générer 100 étudiants
        for ($i = 1; 100 > $i; $i++) {
            // Créer un étudiant
            $etudiant = new Etudiant();
            $etudiant->setPrenom($faker->firstName);
            $etudiant->setNom($faker->lastName);
            $etudiant->setEmail($faker->email);
            $etudiant->setDateNaissance($faker->dateTimeBetween('-30 years', '-17 years'));
            // Créer une référence pour la promotion
            $etudiant->setPromotion($this->getReference('promotion_'.$faker->numberBetween("1", "9")));
            // Persister etudiant
            // Doctrine va générer INSERT INTO
            $manager->persist($etudiant);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            PromotionFixtures::class
        ];
    }

}
