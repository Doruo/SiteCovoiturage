<?php

namespace App\Covoiturage\Modele\Repository;

use App\Covoiturage\Modele\DataObject\Trajet;
use DateMalformedStringException;
use DateTime;

class TrajetRepository extends AbstractRepository
{
    /**
     * @throws DateMalformedStringException
     */
    public static function construireDepuisTableauSQL(array $trajetTableau) : Trajet {
        return new Trajet(
            $trajetTableau["id"],
            $trajetTableau["depart"],
            $trajetTableau["arrivee"],
            new DateTime($trajetTableau["date"]),
            $trajetTableau["prix"],
            UtilisateurRepository::recupererUtilisateurParLogin($trajetTableau["conducteurLogin"]),
            $trajetTableau["nonFumeur"],
        );
    }

    /** @return Trajet[]
     * @throws DateMalformedStringException
     */
    public static function recupererTrajet(): array
    {
        $pdo = ConnexionBaseDeDonnees::getInstance()->getPdo();
        $pdoStatement = $pdo->query("SELECT * FROM trajet");

        $trajets = [];
        foreach ($pdoStatement as $trajetFormatTableau) {
            $trajets[] = self::construireDepuisTableauSQL($trajetFormatTableau);
        }
        return $trajets;
    }

    /**
     * @throws DateMalformedStringException
     */
    public static function recupererTrajetsCommePassager(string $login): array
    {
        $sql = "SELECT * FROM trajet T JOIN passager P ON T.id = P.trajetId WHERE passagerLogin = :login";
        $valeurs = ["login" => $login];

        $pdoStatement = ConnexionBaseDeDonnees::getInstance()->getPdo()->prepare($sql);
        $pdoStatement->execute($valeurs);

        $utilisateurs = [];
        foreach ($pdoStatement as $utilisateurFormatTableau) {
            $utilisateurs[] = self::construireDepuisTableauSQL($utilisateurFormatTableau);
        }
        return $utilisateurs;
    }
}