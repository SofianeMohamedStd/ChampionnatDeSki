<?php

namespace App\InterfaceRepository;

use App\Entites\Profil;

interface ProfilsInterfaceRepository
{
    public function add(Profil $profil);
    public function findAll();
    public function find(int $profil);
    public function findbyName(Profil $profil): array;
}
