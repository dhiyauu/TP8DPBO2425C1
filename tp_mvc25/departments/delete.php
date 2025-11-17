<?php
include_once("../config.php");
include_once("../controllers/DepartmentsController.php");

$controller = new DepartmentsController();
$controller->delete();