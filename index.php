<?php
require_once "./controllers/ChauffeurController.php";
require_once "./controllers/ClientController.php";
require_once "./controllers/VoitureController.php";
require_once "./controllers/TrajetController.php";
$chauffeurController = new ChauffeurController();
$clientController = new ClientController();
$voitureController = new VoitureController();
$trajetController = new TrajetController();
// Vérifie si le paramètre "page" est vide ou non présent dans l'URL
if (empty($_GET['page'])){
    // Si le paramètre est vide, on affiche un message d'erreur
    echo "La page n'existe pas";
}else{
    $url= explode("/",$_GET['page']);
    switch($url[0]){
        case 'chauffeurs':
            if (isset($url[1])){
                echo $chauffeurController->getChauffeurById($url[1]);
            }else{
                echo $chauffeurController->getAllChauffeurs();
            }
           
            break;
        case 'clients':
            if (isset($url[1])){
                echo "Afficher les information du client : ".$url[1];
            }else{
                echo $clientController->getAllClients();
            }
            break;
            case 'voitures':
            if (isset($url[1])){
                echo "Afficher les information de la voiture : ".$url[1];
            }else{
                echo $voitureController->getAllVoitures();
            }
           
            break;
            case 'trajets':
            if (isset($url[1])){
                echo "Afficher les information du trajet : ".$url[1];
            }else{
                echo $trajetController->getAllTrajets();
            }
           
            break;
        default:
        echo "La page n'existe pas";
    }
}

?>
