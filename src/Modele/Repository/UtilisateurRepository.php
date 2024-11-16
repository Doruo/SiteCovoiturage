<?php

namespace App\Covoiturage\Modele\Repository;

use App\Covoiturage\Modele\DataObject\Utilisateur;
use DateMalformedStringException;
use PDOException;

class UtilisateurRepository
{
    public static function construireDepuisTableauSQL(array $utilisateurTableau): Utilisateur
    {
        return new Utilisateur(
            $utilisateurTableau["login"],
            $utilisateurTableau["nom"],
            $utilisateurTableau["prenom"]
        );
    }

    /** @return Utilisateur[] */
    public static function recupererUtilisateurs(): array
    {
        $pdo = ConnexionBaseDeDonnees::getInstance()->getPdo();
        $pdoStatement = $pdo->query("SELECT * FROM utilisateur");

        $utilisateurs = [];
        foreach ($pdoStatement as $utilisateurFormatTableau) {
            $utilisateurs[] = self::construireDepuisTableauSQL($utilisateurFormatTableau);
        }
        return $utilisateurs;
    }


    // REQUETES PREPAREES AVEC CONDITION (WHERE)
    static public function recupererUtilisateurParLogin(string $login): ?Utilisateur
    {

        $sql = "SELECT * FROM utilisateur WHERE login = :loginTag";

        // Préparation de la requête
        $pdoStatement = ConnexionBaseDeDonnees::getInstance()->getPdo()->prepare($sql);

        $values = array("loginTag" => $login);

        $pdoStatement->execute($values);
        $utilisateurFormatTableau = $pdoStatement->fetch();

        if (!$utilisateurFormatTableau) return null;
        return self::construireDepuisTableauSQL($utilisateurFormatTableau);
    }



    public static function ajouter(Utilisateur $utilisateur): bool
    {
        try {
            $sql = "INSERT INTO utilisateur VALUES login = :loginTag, nom = :nomTag, prenom = :prenomTag";

            $pdoStatement = ConnexionBaseDeDonnees::getInstance()->getPdo()->prepare($sql);

            $values = array(
                "login" => $utilisateur->getLogin(),
                "nom" => $utilisateur->getNom(),
                "prenom$" => $utilisateur->getPrenom(),
            );

            $pdoStatement->execute($values);
            return true;
        }
        catch (PDOException) {return false;}
    }

    public static function supprimerParLogin(string $login): bool
    {
        try {
            $sql = "DELETE FROM utilisateur WHERE login = :loginTag";
            // Préparation de la requête
            $pdoStatement = ConnexionBaseDeDonnees::getInstance()->getPdo()->prepare($sql);

            $values = array("loginTag" => $login);

            $pdoStatement->execute($values);
            return true;
        }
        catch (PDOException) {return false;}
    }

    public static function mettreAJour() : void
    {

    }
}