<?php

namespace App\DataFixtures;

use App\Entity\Site;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SiteFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $sites = [
            'St Herblain',
            'Rennes',
            'Niort'
        ];

        foreach ($sites as $key=>$name)
        {
            $site = new Site();
            $site->setNom($name);
            $this->setReference("site_$key", $site);
            $manager->persist($site);

        }

        $manager->flush();
    }
}
