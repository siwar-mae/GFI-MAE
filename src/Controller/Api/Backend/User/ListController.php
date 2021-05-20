<?php


namespace App\Controller\Api\Backend\User;


use App\Service\Backend\User\ListService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{

    /**
     * @Route("/users", name="api_user_get_list", options={"expose": true}, methods={"GET", "HEAD"})
     */
    public function index()
    {
        return $this->render('backend/user/list/index.html.twig');
    }
    /**
     * @Route("/api/users/list", name="api_user_list", options={"expose": true}, methods={"GET", "HEAD"})
     */
    public function __invoke(ListService $listService, Request $request)
    {
        return new JsonResponse($listService->getData());
    }
}