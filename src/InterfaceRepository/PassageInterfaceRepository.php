<?php

namespace App\InterfaceRepository;

use App\Entites\Passage;

interface PassageInterfaceRepository
{
    public function addListePassage(Passage $passage);
}
