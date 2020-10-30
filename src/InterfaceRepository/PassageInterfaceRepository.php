<?php

namespace App\InterfaceRepository;

use App\Entites\Passage;

interface PassageInterfaceRepository
{
    public function addListePassage(Passage $passage);
    public function findAll(): array;
    public function firstorderGeneral();
    public function orderGeneral();
}
