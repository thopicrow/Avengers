<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user", name="user_")
 */
class UserController extends Controller
{
    /**
     * @Route("/profil", name="profil")
     */
    public function afficherProfil()
    {
        $user = $this->getUser();

        return $this->render('user/profil.html.twig', [
            'user'=> $user,
        ]);
    }

    /**
     * @Route("/profil/modifier", name="modifier")
     */
    public function modifierProfil()
    {
        $user = $this->getUser();

        return $this->render('user/modificationProfil.html.twig', [
            'user' => $user
        ]);
    }

}
