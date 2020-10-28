<?php

namespace App\Models;

use App\Models\AbstractModel;
use App\InterfaceRepository\PassageInterfaceRepository;


class PassagesRepository extends AbstractModel implements PassageInterfaceRepository
{
    public function __construct()
    {
        $this->pdo = parent::getPdo();
    }
    public function add($num_passage, $temps, $participant_id)
    {
        $req = $this->pdo->prepare("INSERT INTO passage(num_passage,temps) VALUE (:num_passage,:temps);
        SET @passage = LAST_INSERT_ID();
        INSERT INTO epreuves_participants (passage_id,participants_id) VALUES(@passage,:participants_id)");
        return $req->execute(array(
            'num_passage' => $num_passage,
            'temps' => $temps,
            'participants_id' => $temps

        ));

    }
}