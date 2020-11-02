<?php

namespace App\Controllers;

use App\Entites\Categorie;
use App\Models\CategoriesRepository;
use Symfony\Component\HttpFoundation\Response;
use Twig\Error\LoaderError;
use Twig\Error\SyntaxError;
use Twig\Error\RuntimeError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CategoriesController extends AbstractController
{
    private CategoriesRepository $Category;
    public function __construct()
    {
        $this->twig = parent::getTwig();
        $this->Category = new CategoriesRepository();
    }

    public function showCategorie(): void
    {
        $categories = $this->Category->findAll();
        try {
            $response = new Response($this -> twig -> render(
                'CategorieView.html.twig',
                ['Listecategories' => $categories]
            ));
            $response->send();
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }
    }
    public function categorieAdd(): void
    {
        $request = Request::createFromGlobals();
        $name = $request->get('name');
        $newCategories = new Categorie();
        $newCategories->setNomCategorie($name);
        $checkCategorie = $this->Category->findbyName($newCategories);
        if (empty($checkCategorie)) {
            $addCategory = $this->Category->add($newCategories);
        }
        $response = new RedirectResponse('http://localhost/www/ChampionnatDeSki/categorie');
        $response->send();
    }
    public function categorieDelete(Request $request): void
    {
        $params = explode('/', $request->getPathInfo());

        $btsup = $params[3];
        $this->Category->delete($btsup);
        $response = new RedirectResponse('http://localhost/www/ChampionnatDeSki/categorie');
        $response->send();
    }
}
