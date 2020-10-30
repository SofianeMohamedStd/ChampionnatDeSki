<?php

namespace App\Controllers;

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
        echo $this->twig->render('HomeView.html.twig');
    }
}
