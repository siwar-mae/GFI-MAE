<?php

namespace App\Controller\Api\Type;

use App\Service\Type\ListService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    /**
     * @Route("/api/types/list", name="api_type_list", options={"expose": true}, methods={"GET", "HEAD"})
     */
    public function __invoke(ListService $listService)
    {
        return new JsonResponse($listService->getData());
    }
}
