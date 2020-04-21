<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\ModifprofileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
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
    public function modifierProfil(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {

        $user = $this->getUser();
        $profilForm = $this->createForm(ModifprofileType::class, $user);
        $profilForm->handleRequest($request);

        if ($profilForm->isSubmitted() && $profilForm->isValid()) {
            $pass = $profilForm->get('passwordPlain')->getData();
            if ($encoder->isPasswordValid($user, $pass)) {
                if ($user->getNewPassword() != null) {
                    $hashed = $encoder->encodePassword($user, $user->getNewPassword());
                    $user->setPassword($hashed);
                }

                $em->persist($user);
                $em->flush();
                $this->addFlash('success', 'Les modifications ont bien été enregistrées !');

            } else {
                $this->addFlash('error', 'Le mot de passe est incorrect');
            }
        }

        return $this->render('user/modificationProfil.html.twig', [
            'user'=>$user,
            'profilForm' => $profilForm->createView()
        ]);
    }

    /**
     * @Route("/afficherProfile/{id}", name="afficher")
     * bonjour
     */
    public function afficherProfile($id)
    {
        $userRepo = $this->getDoctrine()->getRepository(User::class);
        $user = $userRepo->find($id);
        return $this->render('user/profil.html.twig',[
            'user'=>$user,
        ]);
    }
}
