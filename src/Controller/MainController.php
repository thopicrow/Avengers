<?php

namespace App\Controller;

use App\Entity\Etat;
use App\Entity\Filter;
use App\Entity\Sortie;
use App\Form\FilterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function home(Request $request, EntityManagerInterface $em)
    {
        $sortieRepo = $this->getDoctrine()->getRepository(Sortie::class);
        $sorties = $sortieRepo->findAll();
        $etatRepo = $this->getDoctrine()->getRepository(Etat::class);

        $now = new \DateTime();

        foreach ($sorties as $sortie)
        {
            if ($sortie->getEtat()->getLibelle() == 'Ouverte' && $sortie->getDateLimiteInscription() < $now)
            {
                $etat = $etatRepo->findOneBy(['libelle' => 'Cloturée']);
                $sortie->setEtat($etat);
            }
            if ($sortie->getEtat()->getLibelle() == 'Cloturée' && $sortie->getDateHeureDebut() < $now)
            {
                $etat = $etatRepo->findOneBy(['libelle' => 'Activité en cours']);
                $sortie->setEtat($etat);
            }
            if ($sortie->getEtat()->getLibelle() == 'Activité en cours' && $sortie->getDateHeureDebut() < date_sub($now, new \DateInterval('PT' . $sortie->getDuree() . 'M')))
            {
                $etat = $etatRepo->findOneBy(['libelle' => 'Passée']);
                $sortie->setEtat($etat);
            }
            if ($sortie->getEtat()->getLibelle() == 'Cloturée' && $sortie->getDateLimiteInscription() > new \DateTime())
            {
                $etat = $etatRepo->findOneBy(['libelle' => 'Ouverture']);
                $sortie->setEtat($etat);
            }

            $em->persist($sortie);
            $em->flush();
        }

        $filter = new Filter();
        $filterForm = $this->createForm(FilterType::class, $filter);
        $filterForm->handleRequest($request);
        $filter->setUser($this->getUser());

        if ($filterForm->isSubmitted() && $filterForm->isValid())
        {
            $sortieRepo = $this->getDoctrine()->getRepository(Sortie::class);
            $sorties = $sortieRepo->findSorties($filter);
        }

        return $this->render('main/home.html.twig', [
            'filterForm' => $filterForm->createView(),
            'sorties' => $sorties,
        ]);
    }

}

