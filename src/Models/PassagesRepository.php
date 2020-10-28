<?php

namespace App\Models;

use App\Entites\Participant;
use App\Entites\Passage;
use App\InterfaceRepository\PassageInterfaceRepository;

class PassagesRepository extends AbstractModel
{
    public function __construct()
    {
        $this->pdo = parent::getPdo();
    }
    public function addListePassage(Passage $passage): bool
    {
        $req = $this->pdo->prepare("INSERT INTO passage(participants_id,temps_passage_1,temps_passage_2,moyenne) 
        VALUE (?,?,?,?)");
        return $req->execute(array(
            $passage->getidParticipant(),
            $passage->getTime1()->format('H:i:s.u'),
            $passage->getTime2()->format('H:i:s.u'),
            $passage->getResultat ()->format('H:i:s.u')

        ));
    }
}
