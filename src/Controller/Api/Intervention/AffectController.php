<?php

namespace App\Controller\Api\Intervention;

use App\Service\Backend\User\ListService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AffectController extends AbstractController
{
    /**
     * @Route("/affect", name="api_intervention_get_affect", options={"expose": true}, methods={"GET", "HEAD"})
     */
    public function index(ListService $listService)
    {
        $users = $listService->getData();
        return $this->render('intervention/affect/index.html.twig', ['users' => $users]);
    }
}
