<?php

namespace App\Entites;

use DateTime;
use Exception;
use DateTimeInterface;

class Participant
{
    /**
     * @var int
     */
    private int $Id;

    /**
     * @var string
     */
    private string $Nom;

    /**
     * @var string
     */
    private string $Prenom;

    /**
     * @var string
     */
    private string $Email;

    /**
     * @var int
     */
    private int $CategorieID;

    /**
     * @var int
     */
    private int $ProfilID;
    /**
     * @var int
     */
    private int $EpreuveID;

    /**
     * @var DateTimeInterface
     */
    private DateTimeInterface $Date;

    /**
     * @var string
     */
    private string $Photo;

    private string $categories;

    private string $profils;

    private int $idParticipant;

    private ?DateTimeInterface $time1;

    private ?DateTimeInterface $time2;


    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->Id;
    }

    public function setId($id): self
    {
        $this->Id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNom(): ?string
    {
        return $this->Nom;
    }

    /**
     * @param $Nom
     * @return Participant
     * @throws Exception
     */
    public function setNom($Nom): self
    {
        if (! preg_match("/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/", $Nom)) {
            throw new Exception('nom invalide');
        } else {
            $this->Nom = $Nom;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    /**
     * @param string $Prenom
     * @return Participant
     * @throws Exception
     */
    public function setPrenom(string $Prenom): self
    {
        if (! preg_match("/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/", $Prenom)) {
            throw new Exception('prenom invalide');
        } else {
            $this->Prenom = $Prenom;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->Email;
    }

    /**
     * @param string $Email
     * @throws Exception
     */
    public function setEmail(string $Email)
    {
        if (! preg_match("/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/", $Email)) {
            throw new Exception('Email invalide');
        }
        $this->Email = $Email;
    }

    /**
     * @return int
     */
    public function getCategorieID(): ?int
    {
        return $this->CategorieID;
    }

    /**
     * @param int $CategorieID
     * @throws Exception
     */
    public function setCategorieID(int $CategorieID)
    {
        if (! is_int($CategorieID) || ($CategorieID <= 0)) {
            throw new Exception('Categorie invalide');
        }
        $this->CategorieID = $CategorieID;
    }

    /**
     * @return int
     */
    public function getProfilID(): ?int
    {
        return $this->ProfilID;
    }

    /**
     * @param int $ProfilID
     * @throws Exception
     */
    public function setProfilID(int $ProfilID)
    {
        if (! is_int($ProfilID) || ($ProfilID <= 0)) {
            throw new Exception('Profil invalide');
        }
        $this->ProfilID = $ProfilID;
    }

    /**
     * @return int
     */
    public function getEpreuveID(): ?int
    {
        return $this->EpreuveID;
    }

    /**
     * @param int $EpreuveID
     * @throws Exception
     */
    public function setEpreuveID(int $EpreuveID)
    {
        if (! is_int($EpreuveID) || ($EpreuveID <= 0)) {
            throw new Exception('Epreuve invalide');
        }
        $this->EpreuveID = $EpreuveID;
    }

    public function getDate(): ?DateTimeInterface
    {
        return $this->Date;
    }

    /**
     * @param String $Date
     * @return Participant
     * @throws Exception
     */
    public function setDate(string $Date): self
    {
        if (! preg_match('/^\d{4}(\-)(((0)[0-9])|((1)[0-2]))(\-)([0-2][0-9]|(3)[0-1])$/', $Date)) {
            throw new Exception('date invalide');
        }
        $Date = DateTime::createFromFormat('Y-m-d', $Date);
        $this->Date = $Date;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhoto(): ?string
    {
        return $this->Photo;
    }

    /**
     * @param string $Photo
     * @throws Exception
     */
    public function setPhoto(string $Photo)
    {
        if (! preg_match("/.*\.(gif|jpe?g|bmp|png)$/", $Photo)) {
            throw new Exception('photo invalide');
        }
        $this->Photo = $Photo;
    }

    public function getcategories(): ?string
    {
        return $this->categories;
    }
    public function setprofils(string $profils): self
    {
            $this->profils = $profils;

        return $this;
    }
    public function getprofils(): ?string
    {
        return $this->profils;
    }

    public function getidParticipant(): ?int
    {
        return $this->idParticipant;
    }

    public function setidParticipant($id): self
    {
        $this->idParticipant = $id;
        return $this;
    }

    public function getTime1(): ?DateTimeInterface
    {
        return $this->time1;
    }

    public function setTime1(string $timeStage): self
    {
        $time = DateTime::createFromFormat('H:i:s', $timeStage);
        $this->time1 = $time;

        return $this;
    }

    public function getTime2(): ?DateTimeInterface
    {
        return $this->time2;
    }

    public function setTime2(string $timeStage): self
    {
        $time = DateTime::createFromFormat('H:i:s', $timeStage);
        $this->time2 = $time;

        return $this;
    }

    public function buildFromTableParticipant(array $dataParticipant): self
    {

        $this->Id = $dataParticipant['id'];
        $this->Nom = $dataParticipant['nom'];
        $this->Prenom = $dataParticipant['prenom'];
        $this->Date = DateTime::createFromFormat('Y-m-d', $dataParticipant['date_de_naissance']);
        $this->Email = $dataParticipant['email'];
        $this->CategorieID = $dataParticipant['categorie_id'];
        $this->ProfilID = $dataParticipant['profil_id'];
        $this->Photo = $dataParticipant['photo'];
        $this->categories = $dataParticipant['nom_categorie'];
        $this->profils = $dataParticipant['nom_profil'];


        return $this;
    }

    public function buildFromTableParticipantForCSV(array $dataParticipant): self
    {
        $this->Id = $dataParticipant['id'];
        $this->Nom = $dataParticipant['nom'];
        $this->Prenom = $dataParticipant['prenom'];
        $this->CategorieID = $dataParticipant['categorie_id'];

        return $this;
    }

}
