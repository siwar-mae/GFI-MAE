<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ErrorController extends AbstractController
{

    public function show(Request $request)
    {
        foreach ($this->get('router')->getRouteCollection()->all() as $name => $route) {
            if($request->getRequestUri() !== $name){
                return $this->render('bundles/TwigBundle/Exception/error404.html.twig');
            }
        }

    }
}