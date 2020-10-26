<?php

namespace App\Models;

use App\Entites\Epreuve;
use App\Repository\EpreuvesRepository;

class Epreuves extends AbstractModel implements EpreuvesRepository
{

    public function __construct()
    {
        $this->pdo = parent::getPdo();
    }

    public function add(Epreuve $epreuve)
    {
        $req = $this->pdo->prepare("INSERT INTO epreuves(lieu,date) VALUE (?,?)");
        return $req->execute(array(
            $epreuve->getLieu(),
            $epreuve->getDate()->format('Y-m-d')
        ));
    }

    public function findAll(): array
    {
        $req = $this->pdo->prepare('SELECT * FROM epreuves');
        $req->execute();

        return $req->fetchAll();
    }

    public function find(int $epreuve)
    {
        $req = $this->pdo->prepare('SELECT * FROM epreuves WHERE id = ?');
        $req->execute(array($epreuve));

        return $req->fetchAll();
    }

    public function findbyName(Epreuve $epreuve): array
    {
        $req = $this->pdo->prepare('SELECT *
        FROM epreuves WHERE lieu = ?');
        $req->execute(array($epreuve->getLieu()));

        return $req->fetchAll();
    }
}
