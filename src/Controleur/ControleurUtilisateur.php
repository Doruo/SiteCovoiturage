<?php

namespace App\Covoiturage\Controleur;
use App\Covoiturage\Modele\DataObject\Utilisateur;
use App\Covoiturage\Modele\Repository\UtilisateurRepository;

class ControleurUtilisateur
{
    public static function afficherListe(): void
    {
        $utilisateurs = UtilisateurRepository::recupererUtilisateurs();     //appel au modèle pour gérer la BD
        $values = array(
            "utilisateurs" => $utilisateurs,
            "titre" => "Liste des utilisateurs",
            "cheminCorpsVue" => "utilisateur/liste.php"
        );
        self::afficherVue($values);
    }

    public static function afficherDetail(): void
    {
        $utilisateur = UtilisateurRepository::recupererUtilisateurParLogin($_GET['login']);     //appel au modèle pour gérer la BD
        $values = array(
            "utilisateur" => $utilisateur,
            "titre" => "Detail utilisateur",
            "cheminCorpsVue" => "utilisateur/detail.php"
        );

        self::afficherVue($values);
    }

    // CREATE
    public static function afficherFormulaireCreation(): void
    {
        $values = array(
            "titre" => "Creer un utilisateur",
            "cheminCorpsVue" => "utilisateur/formulaireCreation.php"
        );
        self::afficherVue($values);
    }

    public static function creerDepuisFormulaire(): void
    {
        $login = $_GET['login'];
        $nom = $_GET['nom'];
        $prenom = $_GET['prenom'];

        if (!isset($login) || !isset($nom) || !isset($prenom)) {
            self::afficherErreur($login);
            return;
        }

        $utilisateur = new Utilisateur($login, $nom, $prenom);

        $utilisateurs = UtilisateurRepository::recupererUtilisateurs();

        if (!$utilisateurs) {
            self::afficherErreur($login);
            return;
        }

        $values["utilisateurs"] = $utilisateurs;

        if (UtilisateurRepository::ajouter($utilisateur))
        {
            $values = array(
                "titre" => "Utilisateur Créee",
                "cheminCorpsVue" => "utilisateur/utilisateurCree.php"
            );
            self::afficherVue($values);
            self::afficherListe();
        }
        else
            self::afficherErreur($login);
    }

    // DELETE
    public static function supprimer(): void
    {
        $login = $_GET['login'];
        if (is_null($login))
            self::afficherErreur($login);

        if (!UtilisateurRepository::supprimerParLogin($login))
            self::afficherErreur($login);

        $values = array(
            "titre" => "Utilisateur Supprimé",
            "cheminCorpsVue" => "utilisateur/utilisateurSupprime.php"
        );

        self::afficherVue($values);
        self::afficherListe();
    }

    // UPDATE
    public static function afficherFormulaireMiseAJour(): void
    {
        $values = array(
            "titre" => "Creer un utilisateur",
            "cheminCorpsVue" => "utilisateur/formulaireCreation.php"
        );
        self::afficherVue($values);
    }

    public static function mettreAJour(): void
    {
        $login = $_GET['login'];

        UtilisateurRepository::supprimerParLogin($login);

        $values = array(
            "titre" => "Utilisateur Supprimé",
            "cheminCorpsVue" => "utilisateur/utilisateurSupprime.php"
        );

        self::afficherVue($values);
        self::afficherListe();
    }

    public static function afficherErreur(string $messageErreur = "") : void
    {
        $values = array(
            "titre" => "Erreur Utilisateur",
            "cheminCorpsVue" => "utilisateur/erreur.php",
            "messageErreur" => $messageErreur
        );

        self::afficherVue($values);
    }

    private static function afficherVue (array $parametres = []): void
    {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require __DIR__ . "/../vue/vueGenerale.php"; // Charge la vue
    }
}