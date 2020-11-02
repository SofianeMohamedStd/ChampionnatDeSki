<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

final class HomeController extends AbstractController
{
    /**
     * @Route("/")
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function homePage()
    {
        $response = new Response($this->twig->render('HomeView.html.twig'));
        $response->send();
    }
}
