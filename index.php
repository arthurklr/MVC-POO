<?php
session_start();


require "config/config.php";
require "controleur/controleur.php";


try {
    if (isset($_SESSION["acces"])) {
        if (isset($_GET["action"])) {
            if ($_GET["action"] == "clients") {
                clients(); // Affichage de la liste des clients
            } else if ($_GET["action"] == "articles") {
                articles();
            } 
            else if ($_GET["action"] == "articlePhoto"){
                articlePhoto($_GET['idArt']);
            }
            else if ($_GET["action"] == "enregArticlePhoto"){
                enregArticlePhoto($_GET['idArt']);
            }
            else if ($_GET["action"] == "commandes") {
                commandes();
            } else if ($_GET["action"] == "commande") {
                if (isset($_GET['idComm'])) {
                    $idComm = (int) $_GET["idComm"];
                    if ($idComm > 0) {
                        commande($idComm);
                    } else {
                        throw new Exception("Identifiant de commande non valide");
                    }
                } else {
                    throw new Exception("Aucun identifiant de commande");
                }
            } else if ($_GET["action"] == "quitter") { // Correction ici
                quitter();
            } else {
                throw new Exception("Action non valide");
            }
        } else {
            accueil();
        }
    } else {
        if (isset($_GET["action"]) && $_GET["action"] == "login") {
            login($_POST['nom'], $_POST['mdp']);
        } else {
            ctlAcces();
        }
    }
} catch (Exception $e) {
    erreur($e->getMessage());
}

