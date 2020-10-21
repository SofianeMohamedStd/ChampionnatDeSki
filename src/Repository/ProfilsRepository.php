<?php


namespace App\Repository;


use App\Entites\Profil;

interface ProfilsRepository
{
public function Add(Profil $profil);
public function findAll();
public function find(int $profil);
}