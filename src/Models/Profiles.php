<?php

namespace App\Models;

use App\Entites\Profil;
use App\Repository\ProfilsRepository;

class Profils implements ProfilsRepository
{
    private object $db;

    public function __construct()
    {
        $pdo = new Model();
        $this->db = $pdo->getPDO();
    }


    public function add(Profil $profil)
    {
        $req = $this->db->prepare("INSERT INTO profils(nom_profil) VALUE (?)");
        return $req->execute(array(
            $profil->getNomProfil()
        ));
    }

    public function findAll(): array
    {
        $req = $this->db->prepare('SELECT * FROM profils');
        $req->execute();

        return $req->fetchAll();
    }

    public function find(int $profil): array
    {
        $req = $this->db->prepare('SELECT * FROM profils WHERE id = ?');
        $req->execute(array($profil));

        return $req->fetchAll();
    }
}
