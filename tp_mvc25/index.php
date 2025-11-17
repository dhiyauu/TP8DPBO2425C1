<?php
//Saya Dhiya Ulhaq dengan NIM 2407716 mengerjakan Tugas Praktikum 8 (MVC) dalam mata kuliah desain & pemrograman berorientasi objek untuk keberkahan-Nya maka saya tidak akan melakukan kecurangan seperti yang telah di spesifikasikan//

// Memuat semua file yang dibutuhkan
include_once "models/DB.php";
include_once "models/Departments.php";
include_once "models/Lecturers.php";
include_once "models/Schedules.php";
include_once "views/Template.php";

// Inisialisasi model dengan koneksi database
$depModel = new Departments("localhost","root","","tp_mvc25");
$lecModel = new Lecturers("localhost","root","","tp_mvc25");
$schModel = new Schedules("localhost","root","","tp_mvc25");

// Ambil seluruh data dari database
$departments = $depModel->getAll();
$lecturers   = $lecModel->getAll();
$schedules   = $schModel->getAll();

// Menyiapkan tabel Departments
$depRows = "";
foreach ($departments as $d) {
    $depRows .= "<tr>
                    <td>{$d['department_name']}</td>
                    <td>{$d['location']}</td>
                 </tr>";
}

// Menyiapkan tabel Lecturers
$lecRows = "";
foreach ($lecturers as $l) {
    $lecRows .= "<tr>
                    <td>{$l['name']}</td>
                    <td>{$l['nidn']}</td>
                 </tr>";
}

// Menyiapkan tabel Schedules
$schRows = "";
foreach ($schedules as $s) {
    $schRows .= "<tr>
                    <td>{$s['lecturer_name']}</td>
                    <td>{$s['day']}</td>
                 </tr>";
}

// Load file template HTML
$view = new Template("index.html");

// Mengganti placeholder dengan data tabel yang sudah dibuat
$view->replace("DATA_DEPARTMENTS", $depRows);
$view->replace("DATA_LECTURERS", $lecRows);
$view->replace("DATA_SCHEDULES", $schRows);

// Tampilkan halaman yang sudah jadi
$view->write();
?>