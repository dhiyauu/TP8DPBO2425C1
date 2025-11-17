<?php
include_once("../config.php");
include_once("../controllers/LecturersController.php");

$controller = new LecturersController();
$controller->delete();