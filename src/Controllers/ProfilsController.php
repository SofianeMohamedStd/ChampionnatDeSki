<?php

namespace App\Controllers;

use App\Entites\Profil;
use App\Models\ProfilesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProfilsController extends AbstractController
{

    private ProfilesRepository $Profil;
    public function __construct()
    {
        $this->twig = parent::getTwig();
        $this->Profil = new ProfilesRepository();
    }

    public function showProfils(): void
    {
        $profils = $this->Profil->findAll();
        var_dump($profils);
        try {
            echo $this -> twig -> render('ProfilView.html.twig', ['Listeprofils' => $profils]);
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }
    }

    public function profilAdd(): void
    {
        $request = Request::createFromGlobals();
        $name = $request->get('name');
        $newProfils = new Profil();
        $newProfils->setNomProfil($name);
        $checkProfil = $this->Profil->findbyName($newProfils);
        if (empty($checkProfil)) {
            $addProfil = $this->Profil->add($newProfils);
        }
        $response = new RedirectResponse('http://localhost/www/ChampionnatDeSki/profil');
        $response->send();
    }
}
