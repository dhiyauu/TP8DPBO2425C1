<?php
// Memanggil file konfigurasi dan semua model + view yang diperlukan
include_once(__DIR__ . "/../config.php");
include_once(__DIR__ . "/../models/Departments.php");
include_once(__DIR__ . "/../models/Lecturers.php");
include_once(__DIR__ . "/../views/DepartmentsView.php");
include_once(__DIR__ . "/../views/DepartmentsAddView.php");
include_once(__DIR__ . "/../views/DepartmentsEditView.php");

class DepartmentsController
{
    private $department; // objek model Departments

    // Constructor: membuat instance Departments model
    function __construct()
    {
        $this->department = new Departments(
            Config::$db_host,
            Config::$db_user,
            Config::$db_pass,
            Config::$db_name
        );
    }

    // HALAMAN UTAMA (LIST DATA DEPARTMENTS)
    public function index()
    {
        // Ambil semua data departments dari model
        $departments = $this->department->getAll();

        // Kirim data ke view untuk ditampilkan
        $view = new DepartmentsView();
        $view->render([
            "departments" => $departments
        ]);
    }

    // MENAMPILKAN FORM ADD + MEMPROSES ADD DATA
    public function add()
    {
        // Jika belum submit -> tampilkan form tambah departemen
        if (!isset($_POST['submit'])) {

            $view = new DepartmentsAddView();
            $view->render();

        } else {
            // Jika form sudah disubmit -> proses simpan data

            $this->department->create(
                $_POST['name'],
                $_POST['location'],
                $_POST['email']
            );

            // Kembali ke halaman daftar
            header("Location: ../departments.php");
        }
    }

    // MENAMPILKAN FORM EDIT + MEMPROSES UPDATE DATA
    public function edit()
    {
        $id = $_GET['id']; // ambil id yang akan diedit

        // Jika belum submit → tampilkan form edit
        if (!isset($_POST['submit'])) {

            // Ambil data 1 baris berdasarkan id
            $departmentData = $this->department->getById($id);

            // Kirim ke view edit
            $view = new DepartmentsEditView();
            $view->render($departmentData);

        } else {

            // Jika sudah submit -> update data ke database
            $this->department->update(
                $id,
                $_POST['name'],
                $_POST['location'],
                $_POST['email']
            );

            // Kembali ke halaman daftar
            header("Location: ../departments.php");
            exit;
        }
    }

    // HAPUS DATA DEPARTEMEN
    public function delete()
    {
        $id = $_GET['id'];

        // set lecturers yang memakai department ini menjadi NULL
        $lecturerUpdate = new Lecturers(Config::$db_host, Config::$db_user, Config::$db_pass, Config::$db_name);
        $lecturerUpdate->open();
        $lecturerUpdate->execute("UPDATE lecturers SET department_id = NULL WHERE department_id = $id");
        $lecturerUpdate->close();

        // hapus department
        $this->department->delete($id);

        header("Location: ../departments.php");
    }


}