<?php
namespace App\Models;

use App\Models\Model;
use App\Entites\Participant;

class Participants extends Model
{
    public function __construct()
    {
        $this->pdo = parent::getPdo();
    }

    public function AddParticipant(Participant $participant)
    {
        $req = $this->pdo->prepare("INSERT INTO participants(categorie_id,profil_id,nom,prenom,date_de_naissance,photo,email) VALUE 
        (?,?,?,?,?,?,?)");
        return $req->execute(array(
            $participant->getCategorieID(),
            $participant->getProfilID(),
            $participant->getNom(),
            $participant->getPrenom(),
            $participant->getDateNaissance(),
            $participant->getPhoto(),
            $participant->getEmail(),

        ));
    }

    public function UpDateParticipant(Participant $participant)
    {
        $req = $this->pdo->prepare("UPDATE participants SET (categorie_id = :categorie_id, profil_id = :profil_id, nom = :nom, prenom = :prenom,
        date_de_naissance = :date_de_naissance, photo = :photo, email = :email WHERE id = :id");
        return $req->execute(array(
            'categorie_id' => $participant->getCategorieID(),
            'profil_id' => $participant->getProfilID(),
            'nom' => $participant->getNom(),
            'prenom' => $participant->getPrenom(),
            'date_de_naissance' => $participant->getDateNaissance(),
            'photo' => $participant->getPhoto(),
            'email' => $participant->getEmail(),
            'id' => $participant->getId(),
        ));
    }

    public function DeleteParticipant(Participant $participant)
    {
        $req = $this->pdo->prepare('DELETE FROM participants where id = ?');
        return $req->execute(array(
            'id' => $participant->getId()
        ));
    }
   
    public function GetAllParticipants(): array
    {
        $req = $this->pdo->prepare('SELECT * FROM participants');
        $req->execute();

        return $req->fetchAll();
    }

    public function GetOneParticipant(Participant $participant):array
    {
        $req = $this->pdo->prepare('SELECT * From participants WHERE id = ?');
        $req->execute(array(
            'id' => $participant->getId()
        ));

        return $req->fetchAll();

    }
}