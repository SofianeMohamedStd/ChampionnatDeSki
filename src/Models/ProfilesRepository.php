<?php

namespace App\Models;

use App\Entites\Profil;
use App\Factory\ProfilsFactory;
use App\InterfaceRepository\ProfilsInterfaceRepository;

class ProfilesRepository extends AbstractModel implements ProfilsInterfaceRepository
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

        return ProfilsFactory::arrayDbCollection($req->fetchAll());
    }

    public function find(int $profil): object
    {
        $req = $this->pdo->prepare('SELECT * FROM profils WHERE id = ?');
        $req->execute(array($profil));

        return ProfilsFactory::dbCollection($req->fetch());
    }

    public function findbyName(Profil $profil): array
    {
        $req = $this->pdo->prepare('SELECT *
        FROM profils WHERE nom_profil = ?');
        $req->execute(array($profil->getNomProfil()));

        return ProfilsFactory::arrayDbCollection($req->fetchAll());
    }
}
