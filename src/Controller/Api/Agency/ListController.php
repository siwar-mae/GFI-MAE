<?php

namespace App\Controller\Api\Agency;

use App\Service\Agency\ListService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    /**
     * @Route("/api/agencies/list", name="api_agency_list", options={"expose": true}, methods={"GET", "HEAD"})
     */
    public function __invoke(ListService $listService)
    {
        return new JsonResponse($listService->getData());
    }
}
