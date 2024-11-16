<?php
use App\Covoiturage\Modele\DataObject\Utilisateur;

echo "<h1>Liste des Utilisateurs</h1>";

/** @var Utilisateur[] $utilisateurs */
foreach ($utilisateurs as $utilisateur)
{
    if (!is_null($utilisateur->getLogin())) {
        $login = htmlspecialchars($utilisateur->getLogin());
        $loginURL = rawurldecode($utilisateur->getLogin());

        echo '<p> Utilisateur de login <a href="/web/controleurFrontal.php?action=afficherDetail&login='.$loginURL.'">' . $login . '.</a></p>';
        echo '<p><a href="/web/controleurFrontal.php?action=supprimer&login='.$loginURL.'">'."Supprimer".'</a></p>';
    }
}
