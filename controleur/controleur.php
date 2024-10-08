<?php

require_once "modele/article.php";
require_once "modele/client.php";
require_once "modele/commande.php";
require_once "index.php";

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
    $cookie = $_COOKIE['page'];
    if ($mdp == UPWD && !empty($nom) && !empty($mdp)) {
        $_SESSION["acces"] = $nom;

        if (!empty($cookie)) {
            if ($cookie == 'clients') {
                clients();
            } elseif ($cookie == 'articles') {
                articles();
            } elseif ($cookie == 'commandes') {
                commandes();
            } /*elseif($cookie == ''){
                commande(idComm: $cookie);
            }*/ elseif ($cookie == 'erreur') {
                erreur("Erreur lors de la navigation.");
            }
        } else {
            accueil();
        }
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
    setcookie("page", "clients", time() + (365 * 24 * 60 * 60)); // 1 an
    require "vue/vueClients.php";
}
function articles()
{
    $objArt = new article();
    $articles = $objArt->getArticles();
    setcookie("page", "articles", time() + (365 * 24 * 60 * 60)); // 1 an
    require "vue/vueArticles.php";
}
function commandes()
{
    $ObjComm = new commande();
    $commandes = $ObjComm->getCommandes();
    setcookie("page", "commandes", time() + (365 * 24 * 60 * 60)); // 1 an
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
        setcookie("page", $idComm, time() + (365 * 24 * 60 * 60)); // 1 an
        require "vue/vueCommande.php";
    } else {
        throw new Exception("Echec de l'affichage de la commande n°$idComm");
    }
}

function erreur($message)
{
    setcookie("page", "erreur", time() + (365 * 24 * 60 * 60)); // 1 an
    require "vue/vueErreur.php";
}
