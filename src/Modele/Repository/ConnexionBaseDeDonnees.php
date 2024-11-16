<?php

namespace App\Covoiturage\Modele\Repository;

use App\Covoiturage\Configuration\ConfigurationBaseDeDonnees;
use PDO;

class ConnexionBaseDeDonnees
{
    private static ?self $instance = null;
    private PDO $pdo;

    public function __construct()
    {
        $nomHote = ConfigurationBaseDeDonnees::getNomHote();
        $port = ConfigurationBaseDeDonnees::getPort();
        $nomBaseDeDonnees = ConfigurationBaseDeDonnees::getNomBaseDeDonnees();
        $login = ConfigurationBaseDeDonnees::getLogin();
        $motDePasse = ConfigurationBaseDeDonnees::getMotDePasse();

        // Connexion à la base de données
        // Le dernier argument sert à ce que toutes les chaines de caractères
        // en entrée et sortie de MySql soit dans le codage UTF-8

        // "mysql:host=root;port=3306;dbname=hayeroot
        $this->pdo = new PDO("mysql:host=$nomHote;port=$port;dbname=$nomBaseDeDonnees", $login, $motDePasse,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

        // On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getPdo(): PDO{
        return self::getInstance()->pdo;
    }

    public static function getInstance(): self
    {
        if (is_null(self::$instance)) self::$instance = new ConnexionBaseDeDonnees();
        return self::$instance;
    }
}