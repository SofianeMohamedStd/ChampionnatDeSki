<?php

namespace App\Entites;

use Exception;

class Categorie
{
    private int $id;
    private string $NomCategorie;

    public function getId(): int 
    {
        return $this->id;
    }

    public function getNomCategorie(): String
    {
        return $this->NomCategorie;
    }

    public function SetNomCategorie(string $NomCategorie)
    {
        if(! preg_match(",^[a-zA-Z0-9[\].-]+$,", $NomCategorie))
        {
            throw new Exception('verifier le nom');
        }
        $this->NomCategorie = $NomCategorie;

        
    }

   
}