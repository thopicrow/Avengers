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
     * @Route("/register", name="register")
     */
    public function register()
    {
        return $this->render('user/register.html.twig');
    }
}
