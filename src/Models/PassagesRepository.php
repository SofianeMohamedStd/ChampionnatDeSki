<?php

namespace App\Models;

use App\Entites\Passage;
use App\Factory\PassagesFactory;
use App\InterfaceRepository\PassageInterfaceRepository;

class PassagesRepository extends AbstractModel implements PassageInterfaceRepository
{
    public function __construct()
    {
        $this->pdo = parent::getPdo();
    }
    public function addListePassage(Passage $passage): bool
    {
        $req = $this->pdo->prepare("INSERT INTO passage(participants_id,temps_passage_1,temps_passage_2) 
        VALUE (?,?,?)");
        return $req->execute(array(
            $passage->getidParticipant(),
            $passage->getTime1(),
            $passage->getTime2(),
        ));
    }

    public function findAll(): array
    {
        $req = $this->pdo->prepare("SELECT id,temps_passage_1,temps_passage_2,
         SEC_TO_TIME(moyenne) as moyenne FROM passage");
        $req->execute();

        return $req->fetchAll() ;
    }
    public function update($result, $id)
    {
        $req = $this->pdo->prepare("UPDATE passage SET moyenne = ? where id = ?");
        $req->execute(array(
            $result,
            $id
        ));
    }

    public function firstorderGeneral()
    {
        $req = $this->pdo->prepare("SELECT passage.id,passage.temps_passage_1, passage.temps_passage_2,
        SEC_TO_TIME(passage.moyenne) as moyenne,participants.nom,participants.prenom
        FROM passage
        INNER JOIN participants
        ON passage.participants_id = participants.id
        ORDER BY moyenne ASC
        LIMIT 3");
        $req->execute();
        return $req->fetchAll() ;
    }
    public function orderGeneral()
    {
        $req = $this->pdo->prepare("SELECT passage.id,passage.temps_passage_1, passage.temps_passage_2,
        SEC_TO_TIME(passage.moyenne) as moyenne,participants.nom,participants.prenom
        FROM passage
        INNER JOIN participants
        ON passage.participants_id = participants.id
        ORDER BY moyenne ASC
        ");
        $req->execute();
        return $req->fetchAll() ;
    }
    public function firstorderByCategorie($id)
    {
        $req = $this->pdo->prepare("SELECT passage.id,passage.temps_passage_1, passage.temps_passage_2,
        SEC_TO_TIME(passage.moyenne) as moyenne,participants.nom,participants.prenom 
        FROM passage 
        INNER JOIN participants 
        ON participants.id = passage.participants_id AND participants.categorie_id = ? 
        ORDER BY moyenne ASC 
        LIMIT 3");
        $req->execute(array($id));
        return $req->fetchAll();
    }
    public function orderByCategorie($id)
    {
        $req = $this->pdo->prepare("SELECT passage.id,passage.temps_passage_1, passage.temps_passage_2,
        SEC_TO_TIME(passage.moyenne) as moyenne,participants.nom,participants.prenom 
        FROM passage 
        INNER JOIN participants 
        ON participants.id = passage.participants_id AND participants.categorie_id = ? 
        ORDER BY moyenne ASC ");
        $req->execute(array($id));
        return $req->fetchAll();
    }
}
