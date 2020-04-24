<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user0 = new User();
        $user0->setUsername('thopi');
        $user0->setPassword('123');
        $user0->setCreatedAt(new \DateTime());
        $user0->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $user0->setEmail('thopi@sortir.com');
        $user0->setNom('thomas');
        $user0->setPrenom('pierrick');
        $user0->setTelephone('0600000000');
        $user0->setSite($this->getReference('site_0'));
        $user0->setProfilePicture('anigif_enhanced11577144362880721-5e9f163e69d59.gif');
        $hashed = $this->encoder->encodePassword($user0, $user0->getPassword());
        $user0->setPassword($hashed);

        $user1 = new User();
        $user1->setUsername('tika');
        $user1->setPassword('aze');
        $user1->setCreatedAt(new \DateTime());
        $user1->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $user1->setEmail('tika@sortir.com');
        $user1->setNom('monnet');
        $user1->setPrenom('fabien');
        $user1->setTelephone('0600000001');
        $user1->setProfilePicture('buddyballentine2-5e9f1989def49.jpeg');
        $user1->setSite($this->getReference('site_0'));
        $hashed = $this->encoder->encodePassword($user1, $user1->getPassword());
        $user1->setPassword($hashed);

        $user2 = new User();
        $user2->setUsername('val');
        $user2->setPassword('cuicui');
        $user2->setCreatedAt(new \DateTime());
        $user2->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $user2->setEmail('valentine@sortir.com');
        $user2->setNom('brunet');
        $user2->setPrenom('valentine');
        $user2->setTelephone('0600000002');
        $user2->setProfilePicture('giphy-5ea010ae78825.gif');
        $user2->setSite($this->getReference('site_2'));
        $hashed = $this->encoder->encodePassword($user2, $user2->getPassword());
        $user2->setPassword($hashed);

        $user3 = new User();
        $user3->setUsername('loaias');
        $user3->setPassword('zqsd');
        $user3->setCreatedAt(new \DateTime());
        $user3->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $user3->setEmail('loaias@sortir.com');
        $user3->setNom('cronn');
        $user3->setPrenom('sebastien');
        $user3->setTelephone('0600000003');
        $user3->setProfilePicture('img_20200422_103946-5ea003b779530.jpeg');
        $user3->setSite($this->getReference('site_1'));
        $hashed = $this->encoder->encodePassword($user3, $user3->getPassword());
        $user3->setPassword($hashed);

        $user4 = new User();
        $user4->setUsername('kenzy');
        $user4->setPassword('bruno');
        $user4->setCreatedAt(new \DateTime());
        $user4->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $user4->setEmail('kenzy@sortir.com');
        $user4->setNom('wafo-tapa');
        $user4->setPrenom('bruno');
        $user4->setTelephone('0600000004');
        $user4->setProfilePicture('3254030936_1_17_nyldtvbj-5ea00ff83185e.gif');
        $user4->setSite($this->getReference('site_0'));
        $hashed = $this->encoder->encodePassword($user4, $user4->getPassword());
        $user4->setPassword($hashed);

        $user5 = new User();
        $user5->setUsername('rv');
        $user5->setPassword('789');
        $user5->setCreatedAt(new \DateTime());
        $user5->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $user5->setEmail('rv@sortir.com');
        $user5->setNom('BOISGONTIER');
        $user5->setPrenom('Herve');
        $user5->setTelephone('0600000009');
        $user5->setSite($this->getReference('site_0'));
        $user5->setProfilePicture('herveconfinement-5ea2d5742bfee.png');
        $hashed = $this->encoder->encodePassword($user5, $user5->getPassword());
        $user5->setPassword($hashed);

        $users = [$user0, $user1, $user2, $user3, $user4, $user5];
        foreach ($users as $key => $value) {

            $this->setReference("user_$key", $value);
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
        return [SiteFixtures::class];
    }
}
