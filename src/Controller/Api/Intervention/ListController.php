<?php

namespace App\Controller\Api\Intervention;

use App\Service\Intervention\ListService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    /**
     * @Route("/list", name="api_intervention_get_list", options={"expose": true}, methods={"GET", "HEAD"})
     */
    public function index(ListService $listService)
    {
        return $this->render('intervention/list/index.html.twig');
    }

    /**
     * @Route("/api/interventions/list", name="api_intervention_list", options={"expose": true}, methods={"GET", "HEAD"})
     */
    public function __invoke(ListService $listService)
    {
        return new JsonResponse($listService->getData());
    }
}
