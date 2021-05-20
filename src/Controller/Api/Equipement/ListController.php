<?php

namespace App\Controller\Api\Equipement;

use App\Service\Equipement\ListService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    /**
     * @Route("/api/equipements/list", name="api_equipement_list", options={"expose": true}, methods={"GET", "HEAD"})
     */
    public function __invoke(ListService $listService, Request $request)
    {
        return new JsonResponse($listService->getData($request->get('code')));
    }
}
