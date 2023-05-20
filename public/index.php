<?php

require("../src/controllers/HomeController.php");

$home_page = new HomeController();
$home_page->homepage();