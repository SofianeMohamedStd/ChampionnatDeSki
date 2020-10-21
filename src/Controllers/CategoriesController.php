<?php

namespace App\Controllers;

use App\Models\Categories;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

class CategoriesController extends AbstractController
{
    private Categories $Category;
    public function __construct()
    {
        $this->loader = new FilesystemLoader('src/Views');
        $this->twig = new Environment($this->loader, []);
        $this->Category = new Categories();
    }

    public function showCategorie(): void
    {
        $categories = $this->Category->findAll();
        var_dump($categories);
        try {
            echo $this -> twig -> render('CategorieView.html.twig', ['categories' => $categories , 'foo' => null]);
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }
    }
}
