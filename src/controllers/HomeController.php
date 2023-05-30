<?php

namespace Controllers;

class HomeController
{
    public function homepage()
    {
        include(__DIR__ . '/../../templates/accueil.php');
    }
}