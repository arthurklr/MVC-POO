<?php
require "config/config.php";
require "controleur/controleur.php";


try {

    if (isset($_GET["action"])) {
        if ($_GET["action"] == "clients")
            clients(); // Affichage de la liste des clients
        else if ($_GET["action"] == "articles")
            articles();
        else if ($_GET["action"] == "commandes")
            commandes();
        else if ($_GET["action"] == "commande") {
            if (isset($_GET['idComm'])) {
                $idComm = (int) $_GET["idComm"];
                if ($idComm > 0)
                    commande($idComm);
                else
                throw new Exception("Identifiant de commande non valide");
            } else {
                throw new Exception("Aucun identifiant de commande");
            }
        } else
            throw new Exception("Action non valide");
    } else
        accueil();
} catch (Exception $e) {
    erreur($e->getMessage());
}
