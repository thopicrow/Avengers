<?php

namespace App\DataFixtures;

use App\Entity\Sortie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\Date;

class SortieFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i <= 20; $i++)
        {
            $dateCreate = rand(0, 10) - 5;
            $dateFinInscription = $dateCreate-1;
            $sortie = new Sortie();
            $sortie->setNom("Sortie $i");
            $sortie->setDateHeureDebut(new \DateTime($dateCreate . 'days'));
            $sortie->setDateLimiteInscription(new \DateTime($dateFinInscription .'days'));
            $sortie->setNbInscriptionMax(rand(5, 8));
            $sortie->setDuree(rand(0, 200));
            $sortie->setInfosSortie("Description de la sortie $i");
            $sortie->setLieu($this->getReference('lieu_' . rand(0, 3)));
            $sortie->setUser($this->getReference('user_' . rand(0, 4)));
            $sortie->setCreatedAt(new \DateTime());
            if ($sortie->getDateLimiteInscription() < new \DateTime())
            {
                $sortie->setEtat($this->getReference('etat_2'));
            }
            if ($sortie->getDateHeureDebut() < new \DateTime())
            {
                $sortie->setEtat($this->getReference('etat_' . rand(3, 4)));
            } else
            {
                $sortie->setEtat($this->getReference('etat_' . rand(0, 1)));
            }
            $sortie->setSite($this->getReference('site_' . rand(0, 2)));
            $sortie->addInscrit($sortie->getUser());

            if ($i === 4)
            {
                $sortie->addInscrit($this->getReference('user_0'));
                $sortie->setEtat($this->getReference('etat_5'));
            }
            if($i ===20)
            {
                $sortie->setDateHeureDebut(new \DateTime('-40 days'));
            }

            $manager->persist($sortie);
        }
        $manager->flush();
    }

    /**
     * @inheritDoc
     *
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
