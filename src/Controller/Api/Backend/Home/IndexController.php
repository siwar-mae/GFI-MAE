<?php

namespace App\Controller\Api\Backend\Home;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class IndexController extends AbstractController
{
    /**
     * @Route("/back", name="back", options={"expose": true}, methods={"GET", "HEAD"})
     *
     * @IsGranted("ROLE_ADMIN")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function __invoke()
    {
        return $this->render('baseBack.html.twig');
    }
}
