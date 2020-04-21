<?php

namespace App\DataFixtures;

use App\Entity\Etat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EtatFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $etats = [
            'Créée',
            'Ouverte',
            'Cloturée',
            'Activité en cours',
            'Passée',
            'Annulée'
        ];

        foreach ($etats as $key=>$name)
        {
            $etat = new Etat();
            $etat->setLibelle($name);
            $this->setReference("etat_$key", $etat);

            $manager->persist($etat);
        }

        $manager->flush();
    }
}
