<?php
include_once("../config.php");
include_once("../controllers/SchedulesController.php");

$controller = new SchedulesController();
$controller->delete();