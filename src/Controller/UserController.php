<?php

namespace App\Controller;


use App\Form\ModifprofileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/user", name="user_")
 */
class UserController extends Controller
{
    /**
     * @Route("/profil", name="profil")
     */
    public function modifierProfil(Request $request,
                                   EntityManagerInterface $em,
                                   UserPasswordEncoderInterface $encoder)
    {
        $userSansModifs = $this->getUser();
        $user = $this->getUser();
        $profilForm = $this->createForm(ModifprofileType::class, $user);
        $profilForm->handleRequest($request);

        if ($profilForm->isSubmitted() && $profilForm->isValid() && $user->getPassword() === $userSansModifs->getPassword()) {
            if ($user->getNewPassword() == null) {
                $hashed=$encoder->encodePassword($user, $user->getPassword());
            } else {
                $hashed=$encoder->encodePassword($user, $user->getNewPassword());
            }
            $user->setPassword($hashed);

            $em->persist($user);
            $em->flush();

        }

        return $this->render('user/modificationProfil.html.twig', [
            'user'=>$user, 'profilForm' => $profilForm->createView()
        ]);

    }

}
