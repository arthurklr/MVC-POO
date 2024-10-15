<?php
$title = TITREONGLET . " - Liste des articles";
$header = NOMSITE;
$titre = "Liste des articles";
$menu = MENU;
ob_start();
?>
<div class="resultat">
  <?php
  if (count($articles)) {
    // Affichage des titres de colonnes du tableau
    echo '<table><tr>';
    echo '<th>Photo</th>';
    foreach ($articles[0] as $cle => $valeur) {
      echo '<th>' . $cle . '</th>';
    }
    echo '</tr>';

    // Affichage des lignes du tableau
    foreach ($articles as $ligne) {
      echo '<tr>';

      if (file_exists(PHOTOARTDIR . '/' . $ligne['Code'] . '.png')) {
        $photo = PHOTOARTDIR . '/' . $ligne['Code'] . '.png';
      } else if (file_exists(PHOTOARTDIR . '/' . $ligne['Code'] . '.jpg')) {
        $photo = PHOTOARTDIR . '/' . $ligne['Code'] . '.jpg';
      } else {
        $photo = PHOTOARTDIR . "/defaut.png";
      }

      echo "<td><a href='index.php?action=articlePhoto&idArt=" . $ligne['Code'] . "'><img height='60px' src='" . $photo . "'></a></td>";
      // Affichage des valeurs d'une ligne
      foreach ($ligne as $valeur) {
        echo '<td>' . $valeur . '</td>';
      }
      echo '</tr>';
    }
    echo '</table>';
  } else
    echo "<div class='reponse'>Aucun client n'est enregistré dans la liste</div>";
  ?>
</div>
<?php
$contenu = ob_get_clean();
$footer = "&copy; MMI Mulhouse";
require "gabarit.php";
