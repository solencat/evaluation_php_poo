<?php

namespace App\Repository;

use App\Database\Mysql;
use App\Entity\Console;
use App\Entity\Game;

class GameRepository
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
     * Méthode qui ajoute une jeu (Game) en BDD
     * @return void
     * @throws \Exception Erreurs SQL
     */
    public function saveGame(Game $game): void {

        try{
            // Requête SQL
            $sql = "INSERT INTO video_game(title, `type`, publish_at, id_console) VALUES (?,?,?,?)";

            // Préparer la requête
            $stmt = $this->connect->prepare($sql);

            // Bind les valeurs
            $stmt->bindValue(1,$game->getTitle(), \PDO::PARAM_STR);
            $stmt->bindValue(2,$game->getType(), \PDO::PARAM_STR);
            $stmt->bindValue(3,$game->getPublishAt(), \PDO::PARAM_STR);
            $stmt->bindValue(4,$game->getConsole()->getId(), \PDO::PARAM_STR);

            // Exécuter la requête
            $stmt->execute();

            // Récupérer le dernier id
            $id = $this->connect->lastInsertId();

            // Setter l'id
            $game->setId($id);

        } catch (\PDOException $e){
            echo "ERREUR PDO: " . $e->getMessage();
        }

    }
    
    /**
     * Méthode qui retourne la liste des jeux (Game)
     * @return array<Game> Retourne le tableau des jeux (Game)
     * @throws \Exception Erreurs SQL
     */
    public function findAllGames(): array 
    {
        try{
            // Requête
            $sql = 
            "SELECT vg.title, vg.type, vg.publish_at, c.name
            FROM video_game vg
            INNER JOIN console c ON c.id = vg.id_console";

            // Préparation de la requête
            $stmt = $this->connect->prepare($sql);

            // Exécuter la requête
            $stmt->execute();

            // Récupérer les données au format tableau associatif
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e){
            echo "ERREUR PDO: " . $e->getMessage();
        }
        
        return $data ?? [];
    }
}
