<?php

namespace App\Controllers;

use App\Models\Categories;
use App\Repository\CategorieRepository;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

final class HomeController extends AbstractController
{
    /**
     * @Route("/")
     * @param $request
     * @param $response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function homePage($request, $response): void
    {
        echo $this->twig->render('HomeView.html.twig', ['user' => false]);
    }

    public function errorPage($error): void
    {
        $error = 'Erreur : ' . $error->getMessage();
        echo $this->twig->render('errorView.html.twig', ['error' => $error]);
    }
}
