<?php

namespace App\Controller\Api\Affectation;

use App\Service\Affectation\ListService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    /**
     * @Route("/api/affectations/list", name="api_affectation_list", options={"expose": true}, methods={"GET", "HEAD"})
     */
    public function __invoke(ListService $listService)
    {
        return new JsonResponse($listService->getData());
    }
}
