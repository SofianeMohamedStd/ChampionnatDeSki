<?php

namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class AbstractController
{
    public object $loader;
    public object $twig;


    public function __construct()
    {
        $this->loader = new FilesystemLoader('src/Views');
        $this->twig = new Environment($this->loader, []);

        return $this->twig;
    }
}
