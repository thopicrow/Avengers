<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
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
        $hashed = $this->encoder->encodePassword($user0, $user0->getPassword());
        $user0->setPassword($hashed);

        $user1 = new User();
        $user1->setUsername('tika');
        $user1->setPassword('bite');
        $user1->setCreatedAt(new \DateTime());
        $user1->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $user1->setEmail('tika@sortir.com');
        $hashed = $this->encoder->encodePassword($user1, $user1->getPassword());
        $user1->setPassword($hashed);

        $user2 = new User();
        $user2->setUsername('valbru');
        $user2->setPassword('cuicui');
        $user2->setCreatedAt(new \DateTime());
        $user2->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $user2->setEmail('valbru@sortir.com');
        $hashed = $this->encoder->encodePassword($user2, $user2->getPassword());
        $user2->setPassword($hashed);

        $user3 = new User();
        $user3->setUsername('loaias');
        $user3->setPassword('zqsd');
        $user3->setCreatedAt(new \DateTime());
        $user3->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $user3->setEmail('loaias@sortir.com');
        $hashed = $this->encoder->encodePassword($user3, $user3->getPassword());
        $user3->setPassword($hashed);

        $users = [$user0, $user1, $user2, $user3];
        foreach ($users as $key => $value) {

            $this->setReference("user_$key", $value);
            $manager->persist($value);
        }

        $manager->flush();
    }
}
