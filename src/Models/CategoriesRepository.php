<?php

namespace App\Models;

use App\Factory\CategoriesFactory;
use App\InterfaceRepository\CategoriesInterfaceRepository;
use App\Entites\Categorie;

class CategoriesRepository extends AbstractModel implements CategoriesInterfaceRepository
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

        return CategoriesFactory::arrayDbCollection($req->fetchAll());
    }

    public function find(int $categorie): object
    {
        $req = $this->pdo->prepare('SELECT * FROM categories WHERE id = ?');
        $req->execute(array($categorie));

        return CategoriesFactory::dbCollection($req->fetch());
    }

    public function findbyName(Categorie $categorie): array
    {
        $req = $this->pdo->prepare('SELECT *
        FROM categories WHERE nom_categorie = ?');
        $req->execute(array($categorie->getNomCategorie()));

        return CategoriesFactory::arrayDbCollection($req->fetchAll());
    }
}
