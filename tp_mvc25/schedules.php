<?php
include_once("config.php");
include_once("controllers/SchedulesController.php");
include_once("views/SchedulesView.php");

$controller = new SchedulesController();
$controller->index();