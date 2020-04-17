<?php

namespace App\DataFixtures;

use App\Entity\Sortie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use http\Client\Curl\User;

class SortieFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i <= 10; $i++) {
            $sortie = new Sortie();
            $sortie->setNom("Sortie $i");
            $sortie->setDateHeureDebut(new \DateTime());
            $sortie->setDateLimiteInscription(new \DateTime('-1 day'));
            $sortie->setNbInscriptionMax(rand(5, 8));
            $sortie->setDuree(rand(0, 200));
            $sortie->setInfosSortie("Description de la sortie $i");
            $sortie->setLieu($this->getReference('lieu_' . rand(0, 3)));
            $sortie->setUser($this->getReference('user_' . rand(0, 4)));
            $sortie->setEtat($this->getReference('etat_' . rand(0, 5)));
            $sortie->setSite($this->getReference('site_' . rand(0, 2)));
            $sortie->addInscrit($sortie->getUser());

            if ($i === 4)
            {
                $sortie->addInscrit($this->getReference('user_0'));
            }
            if($i === 7)
            {
                $sortie->setDateHeureDebut(new \DateTime('-10 days'));
                $sortie->setDateLimiteInscription(new \DateTime('-11 days'));
            }

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
