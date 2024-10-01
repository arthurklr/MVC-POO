<?php

require_once "modele/database.php";

class commande extends database
{
  /*******************************************************
  Retourne la liste des articles
  Entrée :
  Retour :
  [array] : Tableau associatif contenant la liste des articles
  *******************************************************/
  // Retourne la liste des commandes
  public function getCommandes()
  {
    $req = ('SELECT id_comm AS "N° Commande", nom AS "Nom", prenom AS "Prénom", DATE_FORMAT(date,"%d/%m/%Y") AS "Date" ' .
      'FROM commande INNER JOIN client ON commande.id_client = client.id_Client ' .
      'ORDER BY nom, prenom;');
    $commandes = $this->execReq($req);
    return $commandes;
  }

  
}


/*
// Retourne le montant total d'une commande
function getTotalCommande($idComm)
{
  $bdd = connexionBDD();
  $reponse = $bdd->prepare('SELECT SUM(quantite * prix) AS "total" ' .
    'FROM ligne ' .
    'INNER JOIN article ON ligne.id_article = article.id_article ' .
    'WHERE id_comm=? ');
  $reponse->execute(array($idComm));
  $resultat = $reponse->fetchAll(PDO::FETCH_ASSOC);
  return $resultat[0]["total"];
}

// Retourne la liste des articles d'une commande
function getArticlesCommande($idComm)
{
  $bdd = connexionBDD();
  $reponse = $bdd->prepare('SELECT quantite AS "Quantité", designation AS "Désignation", categorie AS "Catégorie", prix AS "Prix" ' .
    'FROM ligne ' .
    'INNER JOIN article ON ligne.id_article = article.id_article ' .
    'WHERE id_comm=?;');
  $reponse->execute(array($idComm));
  $articles = $reponse->fetchAll(PDO::FETCH_ASSOC);
  return $articles;
}

// Retourne l'id_client d'une commande
function getIdClientCommande($idComm)
{
  $bdd = connexionBDD();
  $reponse = $bdd->prepare('SELECT id_client FROM commande WHERE id_comm=?;');
  $reponse->execute(array($idComm));
  $resultat = $reponse->fetchAll(PDO::FETCH_ASSOC);

  if (isset($resultat[0]["id_client"]))
    return $resultat[0]["id_client"];
  else
    throw new Exception("Le client de la commande $idComm n'existe pas");
  // Même instruction avec l' "opérateur ternaire"
  //return isset($resultat[0]["id_client"]) ? $resultat[0]["id_client"] : FALSE;
}

*/