<?php

namespace App\Controller;

use App\Entity\Etat;
use App\Entity\Lieu;
use App\Entity\Sortie;
use App\Form\SortieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sortie", name="sortie_")
 */
class SortieController extends Controller
{
    /**
     * @Route("/add", name="add")
     */
    public function add(Request $request,
                        EntityManagerInterface $em)
    {
        $sortie = new Sortie();
        //recuperation du formulaire dans la nouvelle variable $sortie
        $sortieForm = $this->createForm(SortieType::class, $sortie);
        $sortieForm->handleRequest($request);
        $lieuRepo = $this->getDoctrine()->getRepository(Lieu::class);
        $lieux = $lieuRepo->findAll();


        //verification du formulaire
        if ($sortieForm->isSubmitted() && $sortieForm->isValid())
        {
            $etatRepo = $this->getDoctrine()->getRepository(Etat::class);

            if ($request->get('ajouter') === "Creer la sortie")
            {
                $etat = $etatRepo->findOneBy(['libelle' => 'Créée']);
                $sortie->setEtat($etat);
            } elseif ($request->get('publier') === "Publier la sortie")
            {
                $etat = $etatRepo->findOneBy(['libelle' => 'Ouverte']);
                $sortie->setEtat($etat);
            }

            $sortie->setUser($this->getUser());
            $sortie->setSite($this->getUser()->getSite());
            $sortie->addInscrit($this->getUser());
            $sortie->setCreatedAt(new \DateTime());

            $em->persist($sortie);
            $em->flush();

            //redirection faire la page detail
            return $this->redirectToRoute('sortie_detail', [
                'id' => $sortie->getId()
            ]);
        }

        return $this->render('sortie/add.html.twig', [
            'sortieForm' => $sortieForm->createView(), 'lieux' => $lieux
        ]);
    }

    /**
     * @Route("/detail/{id}", name="detail")
     */
    public function detail($id,
                           Request $request,
                           EntityManagerInterface $em)
    {
        $sortieRepo = $this->getDoctrine()->getRepository(Sortie::class);

        $sortie = $sortieRepo->find($id);

        $sortieForm = $this->createForm(SortieType::class, $sortie);
        $sortieForm->handleRequest($request);

        if ($sortieForm->isSubmitted() && $sortieForm->isValid())
        {
            if ($request->get('publier') === "Publier la sortie")
            {
                $sortie->getEtat()->setLibelle('Ouverte');
                $em->persist($sortie);
                $em->flush();
                return $this->redirectToRoute('sortie_detail', [
                    'sortie'=>$sortie,
                    'id'=>$id
                ]);
            }
            if ($sortie->getAnnuler() != null)
            {
                $sortie->getEtat()->setLibelle('Annulée');
            }
            $em->persist($sortie);
            $em->flush();
            $this->addFlash('success', 'Les modifications ont bien été enregistrées !');
        }

        return $this->render('sortie/detail.html.twig', [
            'sortie' => $sortie,
            'sortieForm' => $sortieForm->createView(),
        ]);
    }

    /**
     * @Route("/inscription/{id}", name="inscription")
     */
    public function inscription($id,
                                EntityManagerInterface $em)
    {
        $sortieRepo = $this->getDoctrine()->getRepository(Sortie::class);
        $sortie = $sortieRepo->find($id);
        $sortie->addInscrit($this->getUser());
        $em->persist($sortie);
        $em->flush();

        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/desincription/{id}", name="desincription")
     */
    public function desinscription($id,
                                   EntityManagerInterface $em)
    {
        $sortieRepo = $this->getDoctrine()->getRepository(Sortie::class);
        $sortie = $sortieRepo->find($id);
        $sortie->removeInscrit($this->getUser());
        $em->persist($sortie);
        $em->flush();

        return $this->redirectToRoute('home');
    }

    public function filter(Sortie $sortie)
    {
        $inscrits = $sortie->getInscrits()->contains($this->getUser());
        return $inscrits;
    }

    /**
     * @Route("lieuId", name="lieu_id")
     * @return Lieu|object
     */
    public function requeteAjax(Request $request)
    {
        if ($request->isXMLHttpRequest())
        {
            $id = $request->get('id');
            $lieuRepo = $this->getDoctrine()->getRepository(Lieu::class);
            $lieu = $lieuRepo->find($id);
            return $lieu;
        }

    }


}
