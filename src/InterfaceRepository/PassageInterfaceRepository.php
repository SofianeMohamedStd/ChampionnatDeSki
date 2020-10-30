<?php

namespace App\InterfaceRepository;

use App\Entites\Passage;

interface PassageInterfaceRepository
{
    public function addListePassage(Passage $passage);
    public function findAll(): array;
    public function firstorderGeneral();
    public function firstorderByCategorie($id);
    public function ordreByAgeFirstInterval();
    public function ordreByAgeSecondeInterval();
    public function ordreByThirdInterval();
    public function ordreByFourthInterval();
}
