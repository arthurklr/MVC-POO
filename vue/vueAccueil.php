<?php
$title = TITREONGLET;
$header = NOMSITE;
$titre = "Administration du magasin";
$menu = MENU;
$contenu = "";
$footer = "&copy; MMI Mulhouse";

$contenu = '<div class="resultat">Bonjour '.$_SESSION['acces'].'</div>';
require "gabarit.php";