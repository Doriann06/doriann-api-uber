<?php
require_once "models/ClientModel.php";
class ClientController
    {
        private $model;
        public function __construct()
        {
            $this->model =new ClientModel();
        }
        public function getAllClients()
        {
            $clients= $this->model->getDBAllClients();
            echo json_encode($clients);
        }
        public function getClientById ($idClient){
            $lignesClient =$this->model->getDBClientById($idClient);
            echo json_encode($lignesClient);
        }
        public function createClient($data){
            $lignesClient = $this->model->createDBClient($data);
            http_response_code(201);
            echo json_encode($lignesClient);
        }
        public function updateClient($id,$data){
            $success = $this->model->updateDBClient($id,$data);
            if ($success){
                http_response_code(204);
            } else{
                http_response_code(404);
                echo json_encode(["message"=> "client non trouvé ou non modifiée"]);
            }
            
        }
    }

?>