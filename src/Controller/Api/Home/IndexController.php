<?php


namespace App\Controller\Api\Home;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class IndexController extends AbstractController
{
    /**
     * @Route("/home", name="home", options={"expose": true}, methods={"GET", "HEAD"})
     */
    public function __invoke()
    {
        return $this->render('home/index.html.twig');
    }
}
