<?php

namespace App\Models;

use Exception;
use PDO;

final class Model
{
    public function getPDO()
    {
        try {
            return new PDO('mysql:host=localhost;dbname=ChampionnatDeSki;', 'root', '');
        } catch (Exception $error) {
            die('Erreur : ' . $error->getMessage());
        }
    }
}
