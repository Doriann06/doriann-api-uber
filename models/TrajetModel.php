<?php
class TrajetModel
{
    private $pdo;
    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=bruno_uber;charset=utf8", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }
    public function getDBAllTrajets()
    {
        $stmt = $this->pdo->query("SELECT * FROM Trajet");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getDBTrajetById ($idTrajet){
        $req="
            SELECT * FROM Trajet 
            WHERE trajet_id= :idTrajet
            ";
        $stmt = $this->pdo->prepare($req);
        $stmt->bindValue(":idTrajet",$idTrajet, PDO::PARAM_INT);
        $stmt->execute();
        $trajet= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $trajet;
    }
    public function getDBDetailTrajetById ($idTrajet){
        $req="
            SELECT trajet_date_et_heure,chauffeur_nom,client_nom FROM possede
            INNER JOIN trajet ON trajet.trajet_id=possede.trajet_id
            INNER JOIN client ON client.client_id=possede.client_id
            INNER JOIN chauffeur ON trajet.chauffeur_id=chauffeur.chauffeur_id
            WHERE  possede.trajet_id=:idTrajet
            ";
        $stmt = $this->pdo->prepare($req);
        $stmt->bindValue(":idTrajet",$idTrajet, PDO::PARAM_INT);
        $stmt->execute();
        $trajet= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $trajet;
    }


}

?>