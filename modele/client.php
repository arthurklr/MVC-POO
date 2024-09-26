<?php

require_once "modele/database.php";

class client extends database
{
  /*******************************************************
  Retourne la liste des articles
  Entrée :
  Retour :
  [array] : Tableau associatif contenant la liste des articles
  *******************************************************/
  // Retourne la liste des clients
  public function getClients()
  {
    $req = ('SELECT id_client AS "N° Client", nom AS "NOM", prenom AS "Prénom" FROM client ORDER BY nom, prenom;');
    $clients = $this->execReq($req);
    return $clients;
  }


  /*******************************************************
  Retourne les informations d'un client liste des articles
  Entrée : idClient [int] : identifiant du client
  Retour :
  [array] : Tableau associatif contenant les informations du client ou FALSE en cas d'erreur
  *******************************************************/
  public function getClient($idClient)
  {
    $req = 'SELECT * FROM client WHERE id_client=?';
    $resultat = $this->execReqPrep($req, array($idClient));

    if (isset($resultat[0])) {
      return $resultat[0];
    } else {
      return false;
    }
  }
}