<?php

namespace App\DataFixtures;

use App\Entity\Lieu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\This;

class LieuFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $lieux = [
            'Karting st seb',
            'Bowling St herblain',
            'Espacegame john doe',
            'Le Fief du Parc'
        ];

        $rues = [
            '33 Rue Marie Curie',
            'Rue du Moulin de la Rousselière',
            '13 Rue des Olivettes',
            'place de atlantis'
        ];

        $latitudes = [47.1900528, 47.2299761, 47.2120976, 47.0833708];
        $longitudes = [-1.491659, -1.6409699, -1.5517287, -1.2580257];


        foreach ($lieux as $key => $name) {
            $lieu = new Lieu();
            $lieu->setNom($name);
            $lieu->setRue($rues[$key]);
            $lieu->setLatitude($latitudes[$key]);
            $lieu->setLongitude($longitudes[$key]);
            $lieu->setVille($this->getReference('ville_'.$key));
            $this->setReference("lieu_$key", $lieu);
            $manager->persist($lieu);
        }

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return [VilleFixtures::class];
    }
}
