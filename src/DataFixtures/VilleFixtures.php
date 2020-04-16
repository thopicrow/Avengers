<?php

namespace App\DataFixtures;

use App\Entity\Ville;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VilleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $villes = [
            'St sebastien',
            'St Herblain',
            'Nantes',
            'gétigné'
        ];

        $zipCodes = ['44230','44800','44200','44190'];
        foreach ($villes as $key=>$name)
        {
            $ville = new Ville();
            $ville->setNom($name);
            $ville->setZipCode($zipCodes[$key]);
            $this->setReference("ville_$key", $ville);
            $manager->persist($ville);
        }

        $manager->flush();
    }
}
