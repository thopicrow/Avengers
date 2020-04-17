<?php

namespace App\Controller;

use App\Entity\Filter;
use App\Entity\Site;
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
            'sorties'=>$sorties,
        ]);

    }
}

