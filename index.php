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
    $method= $_SERVER["REQUEST_METHOD"];
    switch($url[0]){
        case 'chauffeurs':
            switch($method){
                case "GET":
                    if (isset($url[2])){
                        if ($url[2]=="voitures"){
                            echo $chauffeurController->getVoitureByChauffeurById($url[1]);
                        }
                    } else if (isset($url[1])){
                            echo $chauffeurController->getChauffeurById($url[1]);
                    }else{
                        echo $chauffeurController->getAllChauffeurs();
                    }
                    break;
                case "POST":
                    $data=json_decode(file_get_contents("php://input"),true);
                    $chauffeurController->createChauffeur($data);
                    break;
                case "PUT":
                    if (isset($url[1])){
                        $data=json_decode(file_get_contents("php://input"),true);
                        $chauffeurController->updateChauffeur($url[1],$data);
                    } else{
                        http_response_code(400);
                        echo json_encode(["message"=>"ID du chauffeur manquant dans l'URL"]);
                    }
                    break;
                    case "DELETE":
                        if (isset($url[1])){
                            $chauffeurController->deleteChauffeur($url[1]);
                        } else{
                            http_response_code(400);
                            echo json_encode(["message"=>"ID du chauffeur manquant dans l'URL"]);
                        }
                        break;
            }
            break;
            
           
            
        case 'clients':
            switch($method){
                case "GET":
                    if (isset($url[1])){
                        echo $clientController->getClientById($url[1]);
                    }else{
                        echo $clientController->getAllClients();
                    }
                break;
                case "POST":
                    $data=json_decode(file_get_contents("php://input"),true);
                    $clientController->createClient($data);
                break;
                case "PUT":
                    if (isset($url[1])){
                        $data=json_decode(file_get_contents("php://input"),true);
                        $clientController->updateClient($url[1],$data);
                    } else{
                        http_response_code(400);
                        echo json_encode(["message"=>"ID du client manquant dans l'URL"]);
                        }
                break;   
            }
            break;
            
            case 'voitures':
            if (isset($url[1])){
                echo $voitureController->getVoitureById($url[1]);
            }else{
                echo $voitureController->getAllVoitures();
            }
           
            break;
            case 'trajets':
                if (isset($url[2])){
                    if ($url[2]=="details"){
                        echo $trajetController->getDetailTrajetById($url[1]);
                    }
                }else if (isset($url[1])){
                echo $trajetController->getTrajetById($url[1]);
            }else{
                echo $trajetController->getAllTrajets();
            }
           
            break;
        default:
        echo "La page n'existe pas";
    }
}

?>
