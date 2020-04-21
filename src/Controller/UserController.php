<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\ModifprofileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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

                //recupération de l'image
                /**@var UploadedFile $pictureFile */
                $pictureFile = $profilForm->get('profilePicture')->getData();
                if ($pictureFile) {
                    $originalFilename = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME);
                    //necessaire pour securiser import du name de fichier dans l'URL
                    $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $pictureFile->guessExtension();

                    try {
                        $pictureFile->move(
                            $this->getParameter('image_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        //...
                    }
                    $user->setProfilePicture($newFilename);
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
