<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ErrorController extends AbstractController
{
    
    public function __invoke()
    {
        $this->twig = parent::getTwig();
        header("HTTP/1.0 404 Not Found");
        $pageTwig = 'errorView.html.twig';
        $template = $this->twig->load($pageTwig);
        return new Response($template->render());
    }
}
