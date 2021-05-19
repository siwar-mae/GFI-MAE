<?php

namespace App\Controller\Api\Home;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class IndexController extends AbstractController
{
    //     * @Security("is_granted('home')", statusCode=404, message="Access denied You are not authorized to access this page.")

    /**
     * @Route("/home", name="home", options={"expose": true}, methods={"GET", "HEAD"})
     *
     * @IsGranted("ROLE_USER")
     * @Security("is_granted('ROLE_USER')")
     */
    public function __invoke()
    {
        return $this->render('home/index.html.twig');
    }
}
