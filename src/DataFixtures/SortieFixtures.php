<?php

namespace App\DataFixtures;

use App\Entity\Sortie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SortieFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i <=10;$i++)
        {
            $sortie = new Sortie();
            $sortie->setNom("Sortie $i");
            $sortie->setDateHeureDebut(new \DateTime());
            $sortie->setDateLimiteInscription(new \DateTime('+1 day'));
            $sortie->setNbInscriptionMax(rand(0,15));
            $sortie->setDuree(rand(0,200));
            $sortie->setInfosSortie("Description de la sortie $i");
            $sortie->setLieu($this->getReference('lieu_'.rand(0,3)));
            $sortie->setUser($this->getReference('user_'.rand(0,4)));
            $sortie->setEtat($this->getReference('etat_'.rand(0,5)));
            $sortie->setSite($this->getReference('site_'.rand(0,2)));

            $manager->persist($sortie);
        }
        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return [

            LieuFixtures::class,
            EtatFixtures::class,
            SiteFixtures::class,
            UserFixtures::class,
        ];
    }
}
