<?php

namespace App\Entites;

use DateTime;
use Exception;
use DateTimeInterface;

class Epreuve
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $Lieu;

    /**
     * @var DateTimeInterface
     */
    private DateTimeInterface $Date;
    /**
     * @var int
     */
    private int $Idparticipant;
    /**
     * @var string
     */
    private string $nom;
    /**
     * @var string
     */
    private string $prenom;
    /**
     * @var string
     */
    private string $categorie;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLieu(): string
    {
        return $this->Lieu;
    }

    /**
     * @param string $Lieu
     * @return Epreuve
     * @throws Exception
     */
    public function setLieu(string $Lieu): self
    {
        if (! preg_match("/^[a-z]* [0-9]{5}$/", $Lieu)) {
            throw new Exception('Lieu invalide');
        } else {
            $this->Lieu = $Lieu;
        }
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getDate(): ?DateTimeInterface
    {
        return $this->Date;
    }

    /**
     * @param String $Date
     * @return Epreuve
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
    public function buildFromTableEpreuve(array $dataEpreuve): self
    {
        $this->id = $dataEpreuve['id'];
        $this->Lieu = $dataEpreuve['lieu'];
        $this->Date = DateTime::createFromFormat('Y-m-d', $dataEpreuve['date']);

        return $this;
    }
    public function buildTableParticipantForCSV(array $dataParticipant): self
    {
        $this->Idparticipant = $dataParticipant['participants_id'];
        $this->nom = $dataParticipant['nom'];
        $this->prenom = $dataParticipant['prenom'];
        $this->categorie = $dataParticipant['nom_categorie'];


        return $this;
    }
}
