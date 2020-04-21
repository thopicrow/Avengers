<?php

use App\Entity\Lieu;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
if ($request->isXMLHttpRequest()) {
    $id = $request->get('idLieu');
    $lieuRepo = $this->getDoctrine()->getRepository(Lieu::class);
    $lieu = $lieuRepo->find($id);
    return $lieu;
}