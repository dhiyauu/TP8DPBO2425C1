<?php
include_once("../config.php");
include_once("../controllers/LecturersController.php");
include_once("../views/LecturersAddView.php");

$controller = new LecturersController();
$controller->add();