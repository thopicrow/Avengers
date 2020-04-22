<?php

use App\Entity\Lieu;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
function (Request $request) {
    if ($request->isXMLHttpRequest())
    {
        $id = $request->get('id');
        $lieuRepo = $this->getDoctrine()->getRepository(Lieu::class);
        $lieu = $lieuRepo->find($id);
        return new JsonResponse(array('status'=>200, 'lieu'=>$lieu.getVille()));
    } else {
        return new JsonResponse(array('status'=>400));
    }
}