<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SignatureController extends AbstractController
{
    /**
     * @Route("/signature", name="api_signature_get", options={"expose": true}, methods={"GET", "HEAD"})
     */
    public function __invoke(): Response
    {
        return $this->render('signature/list/index.html.twig');
    }
}
