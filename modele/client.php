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
}


/*public function getClient($idClient)
{
  $req = ('SELECT * FROM client WHERE id_client=?');
  $data = array($idClient);
  $client = $this->execReqPrep($req, $data);
  return $client;
}


// Retourne les informations d'un client
function getClient($idClient)
{
$bdd = connexionBDD();
$reponse = $bdd->prepare('SELECT * FROM client WHERE id_client=?');
$reponse->execute(array($idClient));

if ($reponse->rowCount() == 1)
  return $reponse->fetch(PDO::FETCH_ASSOC);
else
  return FALSE;
}*/




