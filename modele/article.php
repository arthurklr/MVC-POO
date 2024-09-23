<?php
require_once "modele/database.php";

class article extends database
{
  /*******************************************************
  Retourne la liste des articles
  Entrée :
  Retour :
  [array] : Tableau associatif contenant la liste des articles
  *******************************************************/
  public function getArticles()
  {
    $req = 'SELECT id_article AS "Code", designation AS "Designation", categorie AS
  "Catégorie", prix AS "Prix" FROM article ORDER BY categorie;';
    $articles = $this->execReq($req);
    return $articles;
  }
}