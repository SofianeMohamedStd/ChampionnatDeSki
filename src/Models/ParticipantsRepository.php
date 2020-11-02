<?php

namespace App\Models;

use App\Entites\Participant;
use App\Factory\ParticipantsFactory;
use App\InterfaceRepository\ParticipantsInterfaceRepository;

class ParticipantsRepository extends AbstractModel implements ParticipantsInterfaceRepository
{


    public function __construct()
    {
        $this->pdo = parent::getPdo();
    }

    public function addParticipant(Participant $participant): bool
    {
        $req = $this->pdo->prepare("INSERT INTO participants(categorie_id,profil_id,nom,
        prenom,date_de_naissance,photo,email) VALUE (?,?,?,?,?,?,?);
        SET @participant_id = LAST_INSERT_ID();
        INSERT INTO epreuves_participants (epreuves_id,participants_id) VALUES(?,@participant_id)");
        return $req->execute(array(
            $participant->getCategorieID(),
            $participant->getProfilID(),
            $participant->getNom(),
            $participant->getPrenom(),
            $participant->getDate()->format('Y-m-d'),
            $participant->getPhoto(),
            $participant->getEmail(),
            $participant->getEpreuveID()

        ));
    }
    public function addPassage(Participant $passage): bool
    {
        $req = $this->pdo->prepare("INSERT INTO passage(participant_id,temps_passage_1,temps_passage_2) 
        VALUE (?,?,?)");
        return $req->execute(array(
            $passage->getidParticipant(),
            $passage->getTime1()->format('i:s.u'),
            $passage->getTime2()->format('i:s.u')
        ));
    }

    public function upDateParticipant(Participant $participant)
    {
        $req = $this->pdo->prepare("UPDATE participants SET (categorie_id = :categorie_id, profil_id = :profil_id,
         nom = :nom, prenom = :prenom,date_de_naissance = :date_de_naissance, photo = :photo, email = :email
          WHERE id = :id");
        return $req->execute(array(
            'CategorieID' => $participant->getCategorieID(),
            'profil_id' => $participant->getProfilID(),
            'nom' => $participant->getNom(),
            'prenom' => $participant->getPrenom(),
            'date_de_naissance' => $participant->getDateNaissance(),
            'photo' => $participant->getPhoto(),
            'email' => $participant->getEmail(),
            'id' => $participant->getId(),
        ));
    }

    public function deleteParticipant(Participant $participant)
    {
        $req = $this->pdo->prepare('DELETE FROM participants where id = ?');
        return $req->execute(array(
            'id' => $participant->getId()
        ));
    }
   
    public function getAllParticipants(): array
    {
        $req = $this->pdo->prepare('SELECT participants.*, categories.nom_categorie,profils.nom_profil
        FROM participants
        INNER JOIN categories
        ON participants.categorie_id = categories.id
        INNER JOIN profils
  	    ON participants.profil_id = profils.id');
        $req->execute();
        //return $req->fetchAll();
        return ParticipantsFactory::arrayDbCollection($req->fetchAll());
    }

    public function getInfoParticipantForCSV(): array
    {
        $req = $this->pdo->prepare('SELECT id,nom,prenom,categorie_id FROM participants');
        $req->execute();
        return ParticipantsFactory::arrayDbCollectionForCSV($req->fetchAll());
    }

    public function getOneParticipant(Participant $participant): array
    {
        $req = $this->pdo->prepare('SELECT * From participants WHERE id = ?');
        $req->execute(array(
            'id' => $participant->getId()
        ));
        return $req->fetchAll();
    }
    public function delete($id)
    {
        $req = $this->pdo->prepare('DELETE FROM epreuves_participants WHERE participants_id = ?;');
        $req->execute(array($id));
    }
    public function deletefromParticipant($ide,$id)
    {
        $req = $this->pdo->prepare('DELETE FROM participants WHERE epreuves_id = ? AND participants_id = $id;');
        $req->execute(array($ide, $id));
    }
}
