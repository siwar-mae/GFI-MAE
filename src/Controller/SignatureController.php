<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SignatureController extends AbstractController
{
    /**
     * @Route("/signature", name="api_signature_get", options={"expose": true}, methods={"GET", "HEAD"})
     */
    public function __invoke(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('signature/list/index.html.twig');
    }
}
