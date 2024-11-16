<?php

namespace App\Covoiturage\Modele\DataObject;

class Utilisateur
{
    private string $login;
    private string $nom;
    private string $prenom;

    public function __construct(string $login, string $nom, string $prenom)
    {
        $this->login = $login;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

    public function getLogin(): string {return $this->login;}

    public function getNom(): string {return $this->nom;}

    public function getPrenom(): string {return $this->prenom;}
}