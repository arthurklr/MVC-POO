<?php
$title = TITREONGLET . " - S'identifier";
$header = NOMSITE;
$titre = "Demande d'authentification";
$menu = '';
ob_start();
?>
<form method="post" action=<?= $_SERVER["PHP_SELF"] . "?action=login" ?>>
    <div class="form_elt">
        <label>
            <span>Nom</span>
            <input type="text" class="texte" name="nom" placeholder="Indiquez votre nom" value="">
        </label>
    </div>
    <div class="form_elt">
        <label>
            <span>Mot de passe</span>
            <input type="password" class="texte" name="mdp" value="">
        </label>
    </div>
    <input type="submit" class="valid" name="ok" value="Valider">
</form>
<?php
$contenu = ob_get_clean();
$footer = "&copy; MMI Mulhouse";
require "gabarit.php";