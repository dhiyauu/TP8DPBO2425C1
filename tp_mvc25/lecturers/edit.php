<?php
include_once("../config.php");
include_once("../controllers/LecturersController.php");
include_once("../views/LecturersEditView.php");

$controller = new LecturersController();
$controller->edit();