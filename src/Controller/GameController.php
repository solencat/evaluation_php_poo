<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Repository\ConsoleRepository;
use App\Repository\GameRepository;
use App\Entity\Console;
use App\Entity\Game;
use App\Utils\Tools;
use DateTime;

class GameController extends AbstractController
{
    //Attributs
    private ConsoleRepository $consoleRepository;
    private GameRepository $gameRepository;

    //Constructeur
    public function __construct()
    {
        //Injection des dependances
        $this->consoleRepository = new ConsoleRepository();
        $this->gameRepository = new GameRepository();
    }

    //Méthodes

    /**
     * Méthode pour ajouter un Jeu (Game)
     * @return mixed Retourne le template
     */
    public function addGame(): mixed 
    {
        $data = [];
        if(isset($_POST["submit"])){

            if(
                !empty($_POST["title"]) &&
                !empty($_POST["type"]) &&
                !empty($_POST["publishAt"]) &&
                !empty($_POST["console"])
            ){
                // Nettoyage des entrées
                $titleClean = Tools::sanitize($_POST["title"]);
                $typeClean = Tools::sanitize($_POST["type"]);
                $publishAtClean = DateTime::createFromFormat("d-m-Y", Tools::sanitize($_POST["publishAt"]));
                $consoleClean = Tools::sanitize($_POST["console"]);

                // Instancier un objet Game
                // $game = new Game($titleClean, $typeClean, $publishAtClean, $consoleClean);

            } else {
                echo "Tous les champs doivent être remplis";
            }







            $consoles = $this->consoleRepository->findAllConsoles();
            // foreach($consoles as $console){
            //     $data["consoles"] = $console;
            // }
            $data["consoles"] = $consoles;
        }
        return $this->render("add_game", "Ajouter un jeu", $data ?? []);
    }

    /**
     * Méthode pour afficher la liste des Jeux (Game)
     * @return mixed Retourne le template
     */
    public function showAllGames(): mixed 
    {
        return "template avec la méthode render";
    }
}
