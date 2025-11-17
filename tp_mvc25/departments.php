<?php

// Menghubungkan konfigurasi & dependencies
include_once("config.php");
include_once("controllers/DepartmentsController.php");
include_once("views/DepartmentsView.php");

// Membuat objek controller
$controller = new DepartmentsController();

// Menjalankan halaman index (menampilkan tabel departments)
$controller->index();