<?php
require_once "models/ChauffeurModel.php";
class ChauffeurController
    {
        private $model;
        public function __construct()
        {
            $this->model =new ChauffeurModel();
        }
        public function getAllChauffeurs()
        {
            $chauffeurs= $this->model->getDBAllChauffeurs();
            echo json_encode($chauffeurs);
        }
        public function getChauffeurById ($idChauffeur){
            $lignesChauffeur =$this->model->getDBChauffeurById($idChauffeur);
            echo json_encode($lignesChauffeur);
        }
        public function getVoitureByChauffeurById($idChauffeur){
            $lignesVoitureByChauffuer=$this->model->getDBVoitureByChauffeurById($idChauffeur);
            echo json_encode($lignesVoitureByChauffuer);

        }
        public function createChauffeur($data){
            $lignesChauffeur = $this->model->createDBChauffeur($data);
            http_response_code(201);
            echo json_encode($lignesChauffeur);
        }
        public function updateChauffeur($id,$data){
            $success = $this->model->updateDBChauffeur($id,$data);
            if ($success){
                http_response_code(204);
            } else{
                http_response_code(404);
                echo json_encode(["message"=> "chauffeur non trouvé ou non modifiée"]);
            }
            
        }
        public function deleteChauffeur($id){
            $success = $this->model->deleteDBChauffeur($id);
            if ($success){
                http_response_code(204);
            } else{
                http_response_code(404);
                echo json_encode(["message"=> "chauffeur introuvable"]);
            }
            
        }
    }
    
//$chauffeurController = new ChauffeurController();
//$chauffeurController->getAllChauffeurs();
//$chauffeurController->getVoitureByChauffeurById(1)
?>