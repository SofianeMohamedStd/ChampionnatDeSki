<?php

namespace App\InterfaceRepository;

use App\Entites\Epreuve;

interface EpreuvesInterfaceRepository
{
    public function add(Epreuve $epreuve);
    public function findAll(): array;
    public function find(int $epreuve);
    public function findbyName(Epreuve $epreuve): array;
}
