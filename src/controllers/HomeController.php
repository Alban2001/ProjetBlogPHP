<?php

namespace Controllers;

class HomeController
{
    public function homepage()
    {
        include_once __DIR__ . '/../../templates/accueil.php';
    }
}