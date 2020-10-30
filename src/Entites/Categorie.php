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
        return $this -> id;
    }

    /**
     * @return String
     */
    public function getNomCategorie(): string
    {
        return $this -> NomCategorie;
    }

    /**
     * @param string $NomCategorie
     * @return Categorie
     * @throws Exception
     */
    public function setNomCategorie(string $NomCategorie): self
    {
        if (! preg_match(",^[a-zA-Z0-9[\].-]+$,", $NomCategorie)) {
            throw new Exception('verifier le nom');
        } else {
            $this -> NomCategorie = $NomCategorie;
        }
        return $this;
    }
    public function buildFromTableCategorie(array $dataCategorie): self
    {
        $this->id = $dataCategorie['id'];
        $this->NomCategorie = $dataCategorie['nom_categorie'];

        return $this;
    }
}
