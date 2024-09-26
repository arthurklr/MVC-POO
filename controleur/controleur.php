<?php

require_once "modele/article.php";
require_once "modele/client.php";
require_once "modele/commande.php";

// Affichage de la page d'accueil
function accueil()
{
    require "vue/vueAccueil.php";
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

    if(!empty($articles) && $client){
        $total = $objComm->getTotalCommande($idComm);
        require "vue/vueCommande.php";
    } else{
        throw new Exception("Echec de l'affichage de la commande n°$idComm");
    }
}

function erreur($message)
{
    require "vue/vueErreur.php";
}
