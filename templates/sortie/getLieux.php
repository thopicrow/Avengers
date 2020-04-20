<?php

use App\Entity\Lieu;
use Symfony\Component\HttpFoundation\JsonResponse;

if ($request->isXMLHttpRequest()) {
    $id = $request->get('idLieu');
    $lieuRepo = $this->getDoctrine()->getRepository(Lieu::class);
    $lieu = $lieuRepo->find($id);
    return new JsonResponse(array('lieu'=>json_encode($lieu)));
}