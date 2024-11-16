<?php

require_once __DIR__ . '/../src/Lib/Psr4AutoloaderClass.php';
use App\Covoiturage\Controleur\ControleurUtilisateur;
use App\Covoiturage\Lib\Psr4AutoloaderClass;

$chargeurDeClasse = new Psr4AutoloaderClass(false);

$chargeurDeClasse->register();
$chargeurDeClasse->addNamespace('App\Covoiturage', __DIR__ . '/../src');

// On récupère l'action passée dans l'URL
$action = $_GET['action'] ?? "afficherListe";

// Appel de la méthode statique $action de ControleurUtilisateur
ControleurUtilisateur::$action();