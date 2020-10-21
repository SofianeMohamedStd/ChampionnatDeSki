<?php

namespace App\Models;

use App\Repository\CategoriesRepository;
use App\Entites\Categorie;

class Categories implements CategoriesRepository
{

    private object $db;

    public function __construct()
    {
        $pdo = new Model();
        $this->db = $pdo->getPDO();
    }



    public function add(Categorie $categorie)
    {
        $req = $this->db->prepare("INSERT INTO categories(nom_categorie) VALUE (?)");
        return $req->execute(array(
            $categorie->getNomCategorie()
            ));
    }

    public function findAll(): array
    {
        $req = $this->db->prepare('SELECT * FROM categories');
        $req->execute();

        return $req->fetchAll();
    }

    public function find(int $categorie): array
    {
        $req = $this->db->prepare('SELECT * FROM categories WHERE id = ?');
        $req->execute(array($categorie));

        return $req->fetchAll();
    }
}
