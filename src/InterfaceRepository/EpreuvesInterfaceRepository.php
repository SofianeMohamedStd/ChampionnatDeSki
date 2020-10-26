<?php

namespace App\Repository;

use App\Entites\Epreuve;

interface EpreuvesRepository
{
    public function add(Epreuve $epreuve);
    public function findAll(): array;
    public function find(int $epreuve);
    public function findbyName(Epreuve $epreuve): array;
}
