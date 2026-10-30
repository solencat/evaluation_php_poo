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
        // Initialiser un tableau associatif $data vide. 
        $data = [];

        // Récupérer la liste des consoles dans $consoles
        $consoles = $this->consoleRepository->findAllConsoles();

        // Placer cette liste dans $data['consoles']
        $data["consoles"] = $consoles;
        // dd($data);

        // Afficher le template template_add_game.php avec render(), son titre et $data.
        return $this->render("add_game", "Ajouter un jeu", $data ?? []);

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
        }
        return $this->render("add_game", "Ajouter un jeu", $data ?? []);
    }

    /**
     * Méthode pour afficher la liste des Jeux (Game)
     * @return mixed Retourne le template
     */
    public function showAllGames(): mixed 
    {
        // Initialiser un tableau associatif $data vide.
        $data = [];

        // Récupérer les jeux dans $games
        $games = $this->gameRepository->findAllGames();

        // Ajouter la liste des jeux à $data['games']. 
        $data["games"] = $games;

        // Afficher le template template_show_all_games.php avec render(), son titre et $data. 

        return $this->render("show_all_games", "Liste des jeux vidéo", $data ?? []);
    }
}
