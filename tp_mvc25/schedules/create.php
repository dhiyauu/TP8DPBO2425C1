<?php
include_once("../config.php");
include_once("../controllers/SchedulesController.php");
include_once("../views/SchedulesAddView.php");

$controller = new SchedulesController();
$controller->add();