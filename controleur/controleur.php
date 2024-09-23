<?php

require "modele/modele.php";

// Affichage de la page d'accueil
function accueil()
{
    require "vue/vueAccueil.php";
}
function clients()
{
    $clients = getClients();
    require "vue/vueClients.php";
}
function articles()
{
    $articles = getArticles();
    require "vue/vueArticles.php";
}
function commandes()
{
    $commandes = getCommandes();
    require "vue/vueCommandes.php";
}

function commande($idComm)
{
    $articles = getArticlesCommande($idComm);
    if(!empty($articles)) {
    $client = getClient(getIdClientCommande($idComm));
    $total = getTotalCommande($idComm);
    require "vue/vueCommande.php";
    } else {
        throw new Exception("Echec de l'affichage de la commande n°$idComm");
    }
}

function erreur($message)
{
    require "vue/vueErreur.php";
}
