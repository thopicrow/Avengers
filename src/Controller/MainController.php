<?php

namespace App\Controller;

use App\Entity\Site;
use App\Entity\Sortie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function home(Request $request)
    {
        $siteRepo = $this->getDoctrine()->getRepository(Site::class);
        $sites = $siteRepo->findAll();

        $keyword = $request->get('keyword');
        $site = $request->get('site');
        if ($site == null)
        {
            $site = $sites[0]->getId();
        }
        $dateDebut = $request->get('date-debut');
        $dateFin = $request->get('date-fin');
        $organisateur = $request->get('organisateur');
        $inscrit = $request->get('inscrit');
        $nonInscrit = $request->get('non-inscrit');
        $past = $request->get('past');
        $currentUser = $this->getUser();

        dump($dateDebut);
        $sortieRepo = $this->getDoctrine()->getRepository(Sortie::class);
        $sorties = $sortieRepo->findSorties($site, $keyword,$organisateur, $currentUser);

//       if ($inscrit === 'on')
//       {
//           dump('inscrit');
//           $sorties = $sortieRepo->findByInscrit($this->getUser());
//           dump($sorties);
//       }
//       if ($nonInscrit == 'on')
//       {
//           dump('non-inscrit');
//           $sorties = $sortieRepo->findByNonInscrit($this->getUser());
//       }
//       if($past === 'on')
//       {
//           dump('past');
//           $sorties = $sortieRepo->findByEtat();
//       }

        return $this->render('main/home.html.twig', [
            'sorties'=>$sorties,
            'sites'=>$sites,
            'keyword'=>$keyword,
            'organisateur'=>$organisateur,
            'currentSite'=>$site,
            'inscrit'=>$inscrit
        ]);

    }
}

