<?php

namespace App\Entites;

use Exception;

class Categorie
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $NomCategorie;
    /**
     * @return int
     */
    public function getId(): int 
    {
        return $this->id;
    }

    /**
     * @return String
     */
    public function getNomCategorie(): String
    {
        return $this->NomCategorie;
    }

    /**
     * @param string $NomCategorie
     * @throws Exception
     */
    public function SetNomCategorie(String $NomCategorie)
    {
        if(! preg_match(",^[a-zA-Z0-9[\].-]+$,", $NomCategorie))
        {
            throw new Exception('verifier le nom');
        }
        $this->NomCategorie = $NomCategorie;

        
    }

   
}