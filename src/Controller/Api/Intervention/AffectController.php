<?php

namespace App\Controller\Api\Intervention;

use App\Service\Intervention\ListService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AffectController extends AbstractController
{
    /**
     * @Route("/affect", name="api_intervention_get_affect", options={"expose": true}, methods={"GET", "HEAD"})
     */
    public function index()
    {
        return $this->render('intervention/affect/index.html.twig');
    }
}
