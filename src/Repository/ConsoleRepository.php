<?php

namespace App\Repository;

use App\Database\Mysql;
use App\Entity\Console;

class ConsoleRepository
{
    //Attribut
    private \PDO $connect;

    //Constructeur
    public function __construct()
    {
        //Injection des dependances
        $this->connect = (new Mysql)->connectBDD();
    }

    //Méthodes
    /**
     * Méthode qui retourne la liste des consoles (Console)
     * @return array<Console> Retourne le tableau des consoles (Console)
     * @throws \Exception Erreurs SQL
     */
    public function findAllConsoles(): array 
    {

        try{
            // Création de la requête
            $sql = "SELECT c.id, c.name, c.manufacturer FROM console c";

            // Préparation de la requête
            $stmt = $this->connect->prepare($sql);

            // Exécuter la requête
            $stmt->execute();

            // Récupération des informations au format tableau associatif
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e){
            echo "ERREUR PDO: " . $e->getMessage();
        }

        return $data ?? [];
    }
}