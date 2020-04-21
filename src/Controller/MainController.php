<?php

namespace App\Controller;

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
     * bonjour
     */
    public function home(Request $request, EntityManagerInterface $em)
    {
        $sortieRepo = $this->getDoctrine()->getRepository(Sortie::class);
        $sorties = $sortieRepo->findAll();

        foreach ($sorties as $sortie)
        {
            if ($sortie->getEtat()->getLibelle() == 'Ouverte' && $sortie->getDateLimiteInscription() < new \DateTime())
            {
                $sortie->getEtat()->setLibelle('Cloturée');
            }
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

        $dateArchive = new \DateTime('-30 days');

        return $this->render('main/home.html.twig', [
            'filterForm' => $filterForm->createView(),
            'sorties' => $sorties,
            'dateArchive'=>$dateArchive,
        ]);
    }

}

