<?php
use App\Covoiturage\Modele\DataObject\Utilisateur;
/** @var Utilisateur $utilisateur */

$loginHtml = htmlspecialchars($utilisateur->getLogin());
$nomHtml = htmlspecialchars($utilisateur->getNom());
$prenomHtml = htmlspecialchars($utilisateur->getPrenom());

echo "<h1>Utilisateur</h1><br>";
echo "<p>$loginHtml</p><br>";
echo "<p>$nomHtml</p><br>";
echo "<p>$prenomHtml</p><br>";