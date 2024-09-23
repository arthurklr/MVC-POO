<?php
$title = TITREONGLET . " - Détail commande n°$idComm";
$header = NOMSITE;
$titre = "Commande n°$idComm";
$menu = MENU;
ob_start();
?>
<div class='resultat'>
  <div class="titreCommande">Client :</div>
  <?= $client['nom'] . " " . $client['prenom'] ?>
  <br>
  <?= $client['adresse'] ?>
  <br>
  <?= $client['ville'] ?>
  <div class="titreCommande">Articles :</div>
  <?php
  // Affichage des titres de colonnes du tableau
  echo '<table><tr>';
  foreach ($articles[0] as $cle => $valeur) {
    echo '<th>' . $cle . '</th>';
  }
  echo '</tr>';

  // Affichage des lignes du tableau
  foreach ($articles as $ligne) {
    echo '<tr>';
    // Affichage des valeurs d'une ligne
    foreach ($ligne as $valeur) {
      echo '<td>' . $valeur . '</td>';
    }
    echo '</tr>';
  }
  echo '</table>';

  ?>
  <div class="titreCommande">Total : <?= $total ?> €</div>
</div>
<?php
$contenu = ob_get_clean();
$footer = "&copy; MMI Mulhouse";
require "gabarit.php";
