<?php
include_once("../config.php");
include_once("../controllers/DepartmentsController.php");
include_once("../views/DepartmentsAddView.php");

$controller = new DepartmentsController();
$controller->add();