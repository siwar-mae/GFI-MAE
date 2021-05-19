<?php

namespace App\Controller\Api\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/back", name="back", options={"expose": true}, methods={"GET", "HEAD"})
     */
    public function __invoke()
    {
        return $this->render('base.html.twig');
    }
}
