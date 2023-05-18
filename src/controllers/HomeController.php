<?php

class HomeController
{
    function __construct()
    {

    }
    function homepage()
    {
        include(__DIR__ . '/../../templates/accueil.php');
    }
}