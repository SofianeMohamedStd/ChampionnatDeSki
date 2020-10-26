<?php

namespace App\Models;

use App\Repository\CategoriesRepository;
use App\Entites\Categorie;

class Categories extends AbstractModel implements CategoriesRepository
{

    public function __construct()
    {
        $this->pdo = parent::getPdo();
    }


    public function add(Categorie $categorie)
    {
        $req = $this->pdo->prepare("INSERT INTO categories(nom_categorie) VALUE (?)");
        return $req->execute(array(
            $categorie->getNomCategorie()
            ));
    }

    public function findAll(): array
    {
        $req = $this->pdo->prepare('SELECT * FROM categories');
        $req->execute();

        return $req->fetchAll();
    }

    public function find(int $categorie): array
    {
        $req = $this->pdo->prepare('SELECT * FROM categories WHERE id = ?');
        $req->execute(array($categorie));

        return $req->fetchAll();
    }

    public function findbyName(Categorie $categorie): array
    {
        $req = $this->pdo->prepare('SELECT *
        FROM categories WHERE nom_categorie = ?');
        $req->execute(array($categorie->getNomCategorie()));

        return $req->fetchAll();
    }
}
