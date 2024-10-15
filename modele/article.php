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

  /*******************************************************
  Retourne la description d'un article
  Entrée : 
    idArt [string] : Identifiant de l'article
  Retour :
  [array] : Tableau associatif contenant les attributs de l'article
   *******************************************************/
  public function getArticle($idArt)
  {
    $req = 'SELECT id_article AS "Code", designation AS "Designation", categorie AS
  "Catégorie", prix AS "Prix" FROM article WHERE id_article=?;';
    $resultat = $this->execReqPrep($req, array($idArt));
    /*var_dump($resultat);
    var_dump($resultat[0]);*/
    return $resultat[0];
  }

  public function updateArticlePhoto($idArt)
  {
    if (isset($_FILES['photoArticle'])) {
      // Test s'il n'y a pas d'erreur
      if ($_FILES['photoArticle']['error'] == 0) {
        // Test si la taille du fichier uploadé est conforme
        if ($_FILES['photoArticle']['size'] <= 500000) {
          // Test si l'extension du fichier uploadé est autorisée
          $infosfichier = new SplFileInfo($_FILES['photoArticle']['name']);
          $extension_upload = $infosfichier->getExtension();
          $extensions_autorisees = array('jpg', 'png');
          if (in_array($extension_upload, $extensions_autorisees)) {
            // Stockage définitif du fichier photo dans le dossier "mesImages"
            $image = 'photoArticle/' . $_FILES['photoArticle']['name'];
            if (move_uploaded_file($_FILES['photoArticle']['tmp_name'], PHOTOARTDIR . '/' . $idArt . '.' . $extension_upload)) {
            } else {
              throw new Exception("Échec du transfert du fichier.");
            }
          } else {
            throw new Exception("Échec du transfert : Type de fichier non autorisé.");
          }
        } else {
          throw new Exception("Échec du transfert : Fichier trop volumineux.");
        }
      } else {
        throw new Exception("Échec du transfert avec le code d'erreur : " . $_FILES['photoArticle']['error']);
      }
    }
  }
}
