<?php
$title = TITREONGLET . " - Liste des commandes";
$header = NOMSITE;
$titre = "Liste des commandes";
$menu = MENU;
ob_start();
?>
<div class="resultat">
  <?php
  if (count($commandes)) {
    // Affichage des titres de colonnes du tableau
    echo '<table><tr>';
    echo '<th class="invisible"></th>';
    foreach ($commandes[0] as $cle => $valeur) {
      echo '<th>' . $cle . '</th>';
    }
    echo '</tr>';

    // Affichage des lignes du tableau
    foreach ($commandes as $ligne) {
      echo '<tr>';
      echo'<td><a class="action" href="index.php?action=commande&idComm='.$ligne['N° Commande'].'">Afficher</a></td>';
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