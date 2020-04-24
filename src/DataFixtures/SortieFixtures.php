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
//        for ($i = 0; $i <= 20; $i++)
//        {
//            $dateCreate = rand(0, 10) - 5;
//            $dateFinInscription = $dateCreate-1;
//            $sortie = new Sortie();
//            $sortie->setNom("Sortie $i");
//            $sortie->setDateHeureDebut(new \DateTime($dateCreate . 'days'));
//            $sortie->setDateLimiteInscription(new \DateTime($dateFinInscription .'days'));
//            $sortie->setNbInscriptionMax(rand(5, 8));
//            $sortie->setDuree(rand(0, 200));
//            $sortie->setInfosSortie("Description de la sortie $i");
//            $sortie->setLieu($this->getReference('lieu_' . rand(0, 3)));
//            $sortie->setUser($this->getReference('user_' . rand(0, 4)));
//            $sortie->setCreatedAt(new \DateTime());
//            if ($sortie->getDateLimiteInscription() < new \DateTime())
//            {
//                $sortie->setEtat($this->getReference('etat_2'));
//            }
//            if ($sortie->getDateHeureDebut() < new \DateTime())
//            {
//                $sortie->setEtat($this->getReference('etat_' . rand(3, 4)));
//            } else
//            {
//                $sortie->setEtat($this->getReference('etat_' . rand(0, 1)));
//            }
//            $sortie->setSite($this->getReference('site_' . rand(0, 2)));
//            $sortie->addInscrit($sortie->getUser());
//
//            if ($i === 4)
//            {
//                $sortie->addInscrit($this->getReference('user_0'));
//                $sortie->setEtat($this->getReference('etat_5'));
//            }
//            if($i ===20)
//            {
//                $sortie->setDateHeureDebut(new \DateTime('-40 days'));
//            }
//
//            $manager->persist($sortie);
//        }
//        $manager->flush();

        $sortie1 = new Sortie();
        $sortie1->setNom("Apéro Palet");
        $sortie1->setDateHeureDebut(new \DateTime('2020-04-18 19:00:00'));
        $sortie1->setDateLimiteInscription(new \DateTime('2020-04-15'));
        $sortie1->setNbInscriptionMax(8);
        $sortie1->setDuree(180);
        $sortie1->setInfosSortie("Apéro sympa avec parties de palet");
        $sortie1->setLieu($this->getReference('lieu_3'));
        $sortie1->setUser($this->getReference('user_2'));
        $sortie1->setSite($sortie1->getUser()->getSite());
        $sortie1->setEtat($this->getReference('etat_4'));
        $sortie1->setCreatedAt(new \DateTime());


        $sortie2 = new Sortie();
        $sortie2->setNom("Escape game");
        $sortie2->setDateHeureDebut(new \DateTime('2020-04-25 14:00:00'));
        $sortie2->setDateLimiteInscription(new \DateTime('2020-04-17'));
        $sortie2->setNbInscriptionMax(4);
        $sortie2->setDuree(60);
        $sortie2->setInfosSortie("Escape game john doe");
        $sortie2->setLieu($this->getReference('lieu_2'));
        $sortie2->setUser($this->getReference('user_4'));
        $sortie2->setSite($sortie2->getUser()->getSite());
        $sortie2->setEtat($this->getReference('etat_2'));
        $sortie2->setCreatedAt(new \DateTime());

        $sortie3 = new Sortie();
        $sortie3->setNom("Bowling");
        $sortie3->setDateHeureDebut(new \DateTime('2020-05-11 18:00:00'));
        $sortie3->setDateLimiteInscription(new \DateTime('2020-05-07'));
        $sortie3->setNbInscriptionMax(8);
        $sortie3->setDuree(180);
        $sortie3->setInfosSortie("strike ou pas strike !!!");
        $sortie3->setLieu($this->getReference('lieu_1'));
        $sortie3->setUser($this->getReference('user_0'));
        $sortie3->setSite($sortie3->getUser()->getSite());
        $sortie3->setEtat($this->getReference('etat_1'));
        $sortie3->setCreatedAt(new \DateTime());

        $sortie4 = new Sortie();
        $sortie4->setNom("Karting");
        $sortie4->setDateHeureDebut(new \DateTime('2020-07-25 14:00:00'));
        $sortie4->setDateLimiteInscription(new \DateTime('2020-07-15'));
        $sortie4->setNbInscriptionMax(8);
        $sortie4->setDuree(180);
        $sortie4->setInfosSortie("Initiation pour débutants");
        $sortie4->setLieu($this->getReference('lieu_0'));
        $sortie4->setUser($this->getReference('user_3'));
        $sortie4->setSite($sortie4->getUser()->getSite());
        $sortie4->setEtat($this->getReference('etat_1'));
        $sortie4->setCreatedAt(new \DateTime());

        $sortie5 = new Sortie();
        $sortie5->setNom("Presentation projet");
        $sortie5->setDateHeureDebut(new \DateTime('2020-04-24 14:00:00'));
        $sortie5->setDateLimiteInscription(new \DateTime('2020-04-23'));
        $sortie5->setNbInscriptionMax(8);
        $sortie5->setDuree(30);
        $sortie5->setInfosSortie("Presentation du projet Avengers");
        $sortie5->setLieu($this->getReference('lieu_3'));
        $sortie5->setUser($this->getReference('user_0'));
        $sortie5->setSite($sortie5->getUser()->getSite());
        $sortie5->setEtat($this->getReference('etat_1'));
        $sortie5->setCreatedAt(new \DateTime());

        $sorties = [$sortie1, $sortie2, $sortie3, $sortie4, $sortie5];
        foreach ($sorties as $key => $value) {
            $manager->persist($value);
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
