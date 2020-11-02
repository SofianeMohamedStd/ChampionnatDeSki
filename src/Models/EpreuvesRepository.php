<?php

namespace App\Models;

use App\Entites\Epreuve;
use App\Factory\EpreuvesFactory;
use App\InterfaceRepository\EpreuvesInterfaceRepository;

class EpreuvesRepository extends AbstractModel implements EpreuvesInterfaceRepository
{

    public function __construct()
    {
        $this->pdo = parent::getPdo();
    }

    public function add(Epreuve $epreuve)
    {
        $req = $this->pdo->prepare("INSERT INTO epreuves(lieu,date) VALUE (?,?)");
        return $req->execute(array(
            $epreuve->getLieu(),
            $epreuve->getDate()->format('Y-m-d')
        ));
    }

    public function findAll(): array
    {
        $req = $this->pdo->prepare('SELECT * FROM epreuves');
        $req->execute();

        return $req->fetchAll();
    }

    public function find(int $epreuve): object
    {
        $req = $this->pdo->prepare('SELECT * FROM epreuves WHERE id = ?');
        $req->execute(array($epreuve));

        return EpreuvesFactory::dbCollection($req->fetch());
    }

    public function findbyName(Epreuve $epreuve): array
    {
        $req = $this->pdo->prepare('SELECT *
        FROM epreuves WHERE lieu = ?');
        $req->execute(array($epreuve->getLieu()));

        return EpreuvesFactory::arrayDbCollection($req->fetchAll());
    }
    public function findparticipantbyEpreuve($id)
    {
        $req = $this->pdo->prepare('SELECT epreuves_participants.*, categories.*,profils.*,participants.*
FROM epreuves_participants 
INNER JOIN participants ON 
epreuves_participants.participants_id = participants.id 
INNER JOIN epreuves ON 
epreuves_participants.epreuves_id = epreuves.id 
INNER JOIN categories ON
participants.categorie_id = categories.id
INNER JOIN profils ON
participants.profil_id = profils.id
WHERE epreuves.id= ? ');
        $req->execute(array($id));

        return $req->fetchAll();
    }
    public function findparticipantByEpreuveForCSV($id)
    {
        $req = $this->pdo->prepare('SELECT epreuves_participants.participants_id,categories.nom_categorie,participants.nom,participants.prenom
FROM epreuves_participants 
INNER JOIN participants ON 
epreuves_participants.participants_id = participants.id 
INNER JOIN epreuves ON 
epreuves_participants.epreuves_id = epreuves.id 
INNER JOIN categories ON
participants.categorie_id = categories.id
INNER JOIN profils ON
participants.profil_id = profils.id
WHERE epreuves.id= ? ');
        $req->execute(array($id));

        return EpreuvesFactory::arrayDbCollectionCSV($req->fetchAll()) ;
    }

}
