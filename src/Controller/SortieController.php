<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sortie", name="sortie_")
 */
class SortieController extends Controller
{
    /**
     * @Route("/add", name="add")
     */
    public function add()
    {


        return $this->render('sortie/index.html.twig', [
            'controller_name' => 'SortieController',
        ]);
    }
}
