<?php

namespace App\Models;

use App\Entites\Profil;
use App\Repository\ProfilsRepository;

class Profiles extends AbstractModel implements ProfilsRepository
{
    

    public function __construct()
    {
        $this->pdo = parent::getPdo();
    }

    public function add(Profil $profil)
    {
        $req = $this->pdo->prepare("INSERT INTO profils(nom_profil) VALUE (?)");
        return $req->execute(array(
            $profil->getNomProfil()
        ));
    }

    public function findAll(): array
    {
        $req = $this->pdo->prepare('SELECT * FROM profils');
        $req->execute();

        return $req->fetchAll();
    }

    public function find(int $profil): array
    {
        $req = $this->pdo->prepare('SELECT * FROM profils WHERE id = ?');
        $req->execute(array($profil));

        return $req->fetchAll();
    }

    public function findbyName(Profil $profil): array
    {
        $req = $this->pdo->prepare('SELECT *
        FROM profils WHERE nom_profil = ?');
        $req->execute(array($profil->getNomProfil()));

        return $req->fetchAll();
    }
}
