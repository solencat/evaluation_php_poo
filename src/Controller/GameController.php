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

        // Vérifier que le formulaire a été soumis. 
        if(isset($_POST["submit"])){
            
            // Vérifier que les champs attendus sont tous renseignés : title, type, publish_at et l’identifiant de console. 
            if(
                !empty($_POST["title"]) &&
                !empty($_POST["type"]) &&
                !empty($_POST["publishAt"]) &&
                !empty($_POST["consoles"][0])
            ){
                
                // Nettoyage des entrées
                $titleClean = Tools::sanitize($_POST["title"]);
                $typeClean = Tools::sanitize($_POST["type"]);
                $publishAtClean = Tools::sanitize($_POST["publishAt"]);
                $idConsoleClean = Tools::sanitize($_POST["consoles"][0]);

                // Instancier un objet Game
                switch ($idConsoleClean){
                    case 1:
                        $console = new Console("PlayStation 5", "Sony");
                        break;
                    case 2:
                        $console = new Console("Switch", "Nintendo");
                        break;
                    case 3:
                        $console = new Console("Xbox Series X", "Microsoft");
                        break;
                    case 4:
                        $console = new Console("Steam Deck", "Valve");
                        break;
                    default:
                        exit("Error not found");
                }
                $game = new Game($titleClean, $typeClean, new DateTime($publishAtClean), $console);
                // dd($game);

                // [TO-DO]: saveGame() pose problème

                // Appeler la méthode saveGame()
                $this->gameRepository->saveGame($game);
                
                // Renseigner $data['valid'] pour afficher un message de succès lorsque l’enregistrement a réussi.
                $data["valid"] = "Le jeu a bien été enregistré en base de données!";

            } else {
                $data["error"] = "Tous les champs doivent être remplis";
            }
            dd($data);
        }

        // Afficher le template template_add_game.php avec render(), son titre et $data.
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
        // dd($data);

        // Afficher le template template_show_all_games.php avec render(), son titre et $data. 

        return $this->render("show_all_games", "Liste des jeux vidéo", $data ?? []);
    }
}
