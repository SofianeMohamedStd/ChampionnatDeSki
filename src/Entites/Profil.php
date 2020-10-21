<?php

namespace App\Entites;

use Exception;

class Profil
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $NomProfil;

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
    public function getNomProfil(): string
    {
        return $this->NomProfil;
    }

    /**
     * @param string $NomProfil
     * @throws Exception
     */
    public function setNomProfil(string $NomProfil)
    {
        if (! preg_match(",^[a-zA-Z0-9[\].-:]+$,", $NomProfil)) {
            throw new Exception('verifier le nom');
        }
        $this->NomProfil = $NomProfil;
    }
}
