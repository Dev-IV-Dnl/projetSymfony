<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\produit;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            $produit = new Produit();
            $produit
                ->setNomProduit("Produit n° $i")
                ->setImageProduit("http://placehold.it/350x150")
                ->setDescriptionProduit("<p>Description du produit n°$i</p>")
                ->setPrixProduit(1+$i)
                ->setDatePublication(new \DateTime());
            $manager->persist($produit);
        }
        $manager->flush();
    }
}