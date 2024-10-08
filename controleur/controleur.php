<?php

require_once "modele/article.php";
require_once "modele/client.php";
require_once "modele/commande.php";

//Affichage de la page de contrôle d'accès
function ctlAcces()
{
    require "vue/vueCtlAcces.php";
}

// Affichage de la page d'accueil
function accueil()
{
    require "vue/vueAccueil.php";
}

// Authentification sur le site
function login($nom, $mdp)
{
    if ($mdp == UPWD && !empty($nom) && !empty($mdp)) {
        $_SESSION["acces"] = $nom;
        accueil();
        setcookie("page", $_SERVER['REQUEST_URI'], expires_or_options: time() + (3600 * 24 * 30 * 12));
    } else {
        ctlAcces();
    }
}

function quitter()
{
    session_destroy();
    setcookie(session_name(), '', 1, '/');
    header('Location: index.php');
}


function clients()
{
    $objCl = new Client();
    $clients = $objCl->getClients();
    require "vue/vueClients.php";
}
function articles()
{
    $objArt = new article();
    $articles = $objArt->getArticles();
    require "vue/vueArticles.php";
}
function commandes()
{
    $ObjComm = new commande();
    $commandes = $ObjComm->getCommandes();
    require "vue/vueCommandes.php";
}

function commande($idComm)
{
    $objComm = new Commande();
    $ObjClient = new client();

    $articles = $objComm->getArticlesCommande($idComm);
    $idClient = $objComm->getIdClientCommande($idComm);
    $client = $ObjClient->getClient($idClient);

    if (!empty($articles) && $client) {
        $total = $objComm->getTotalCommande($idComm);
        require "vue/vueCommande.php";
    } else {
        throw new Exception("Echec de l'affichage de la commande n°$idComm");
    }
}

function erreur($message)
{
    require "vue/vueErreur.php";
}
