<?php

namespace Controllers;

class HomeController
{
    /**
     * Affichage de la page d'accueil
     *
     * @return void
     */
    public function homepage()
    {
        include_once __DIR__ . '/../../templates/accueil.php';
    }
}