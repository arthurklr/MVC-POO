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

  public function getArticlesCommande($idComm)
  {
    $req = ('SELECT quantite AS "Quantité", designation AS "Désignation", categorie AS "Catégorie", prix AS "Prix" ' .
      'FROM ligne ' .
      'INNER JOIN article ON ligne.id_article = article.id_article ' .
      'WHERE id_comm=?;');
    $articles = $this->execReqPrep($req, array($idComm));
    return $articles;
  }


  public function getTotalCommande($idComm)
  {
    $req = ('SELECT SUM(quantite * prix) AS "total" ' .
      'FROM ligne ' .
      'INNER JOIN article ON ligne.id_article = article.id_article ' .
      'WHERE id_comm=?');
    $total = $this->execReqPrep($req, array($idComm));
    return $total;
  }

  public function getIdClientCommande($idComm)
  {
    $req = 'SELECT id_client FROM commande WHERE id_comm=?;';
    $resultat = $this->execReqPrep($req, array($idComm));

    if (isset($resultat[0]['id_client'])) {
      return $resultat[0]['id_client'];
    } else {
      return FALSE;
    }

  }
}