<?php

namespace App\Entites;

use DateTime;
use Exception;
use DateTimeInterface;

class Passage
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var int
     */
    private int $NumPassage;

    /**
     * @var DateTimeInterface
     */
    private DateTimeInterface $TempDePassage;


    public function getId(): int
    {
        return $this->id;
    }

    public function getNumPassage(): int
    {
        return $this->NumPassage;
    }
    public function setNumPassage($NumPassage): self
    {
        if (! is_int($numPassage) || $NumPassage <= 0 || $numPassage > 2) {
            throw new Exception('Numero passage invalide');
        } else {
            $this->NumPassage = $NumPassage;
        }
        return $this;
    }

    public function getTempDePassage(): DateTimeInterface
    {
        return $this->DateDePassage;
    }

    public function setTempDePassage(string $DateDePassage): self
    {
        if (! preg_match("/^([0-9]{1,2}:[0-5]{1}[0-9]{1}.[0-9]{1,3})$/", $DateDePassage)) {
            throw new Exception('Date Invalide');
        } else {
            $date = DateTime::createFromFormat('i:s.u', $DateDePassage);
            $this->DateDePassage = $date;
    
            return $this;
        }
    }
}
