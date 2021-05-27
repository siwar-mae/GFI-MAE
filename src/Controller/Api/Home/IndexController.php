<?php

namespace App\Controller\Api\Home;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class IndexController extends AbstractController
{
    /**
     * @Route("/home", name="home", options={"expose": true}, methods={"GET", "HEAD"})
     *
     * @IsGranted("ROLE_USER")
     * @Security("is_granted('ROLE_USER')")
     */
    public function __invoke(\Symfony\Component\Security\Core\Security $security)
    {
        return $this->render('home/index.html.twig', ['user' => $security->getUser()]);
    }
}
