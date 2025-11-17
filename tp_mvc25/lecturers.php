<?php
include_once("config.php");
include_once("controllers/LecturersController.php");
include_once("views/LecturersView.php");

$controller = new LecturersController();
$controller->index();