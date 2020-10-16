<?php

namespace App\Controllers;

final class HomeController extends Controller
{
    /**
     * @Route("/")
     */
    public function homePage($request, $response): void
    {
        echo $this->twig->render('HomeView.html.twig', ['newUser' => false ]);
    }

    public function errorPage($error): void
    {   
        $error = 'Erreur : ' . $error->getMessage();
        echo $this->twig->render('errorView.html.twig', ['error' => $error]);
    }
}
  
