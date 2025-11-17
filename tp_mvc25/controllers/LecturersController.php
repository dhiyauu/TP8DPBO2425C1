<?php
// Memuat konfigurasi, model, dan view
include_once(__DIR__ . "/../config.php");
include_once(__DIR__ . "/../models/Lecturers.php");
include_once(__DIR__ . "/../models/Departments.php");
include_once(__DIR__ . "/../models/Schedules.php");
include_once(__DIR__ . "/../views/LecturersView.php");
include_once(__DIR__ . "/../views/LecturersAddView.php");
include_once(__DIR__ . "/../views/LecturersEditView.php");

class LecturersController
{
    private $lecturer;     // model lecturers
    private $department;   // model departments

    // Membuat objek model ketika controller dibangun
    function __construct()
    {
        $this->lecturer = new Lecturers(
            Config::$db_host,
            Config::$db_user,
            Config::$db_pass,
            Config::$db_name
        );

        $this->department = new Departments(
            Config::$db_host,
            Config::$db_user,
            Config::$db_pass,
            Config::$db_name
        );
    }

    // Menampilkan semua data lecturers
    public function index()
    {
        // Ambil seluruh data dosen
        $lecturerData = $this->lecturer->getAll();

        // Ambil seluruh data departemen
        $departmentData = $this->department->getAll();

        // Kirim data ke view untuk ditampilkan
        $view = new LecturersView();
        $view->render([
            "lecturers" => $lecturerData,
            "departments" => $departmentData
        ]);
    }

    // Menampilkan form tambah atau memproses tambah data
    public function add()
    {
        // Jika form belum dikirim, tampilkan halaman add
        if (!isset($_POST['submit'])) {

            // Ambil data department untuk dropdown
            $departmentData = $this->department->getAll();

            // Tampilkan form add
            $view = new LecturersAddView();
            $view->render($departmentData);

        } else {

            // Simpan data baru
            $this->lecturer->create(
                $_POST['name'],
                $_POST['nidn'],
                $_POST['phone'],
                $_POST['join_date'],
                $_POST['department_id']
            );

            // Kembali ke halaman utama lecturers
            header("Location: /tp_mvc25/lecturers.php");
            exit;
        }
    }

    // Menampilkan form edit atau memproses update data
    public function edit()
    {
        $id = $_GET['id']; // id dosen yang akan diedit

        // Jika form belum dikirim, tampilkan form
        if (!isset($_POST['submit'])) {

            // Data dosen berdasarkan id
            $lecturerData = $this->lecturer->getById($id);

            // Data department untuk dropdown
            $departmentData = $this->department->getAll();

            // Tampilkan halaman edit
            $view = new LecturersEditView();
            $view->render($lecturerData, $departmentData);

        } else {

            // Update data dosen
            $this->lecturer->update(
                $id,
                $_POST['name'],
                $_POST['nidn'],
                $_POST['phone'],
                $_POST['join_date'],
                $_POST['department_id']
            );

            // Redirect ke halaman lecturers
            header("Location: /tp_mvc25/lecturers.php");
            exit;
        }
    }

    // Menghapus data lecturer
    public function delete()
    {
        $id = $_GET['id'];

        // Hapus dulu semua schedules yang memakai lecturer ini
        $schedule = new Schedules(
            Config::$db_host,
            Config::$db_user,
            Config::$db_pass,
            Config::$db_name
        );

        $schedule->open();
        $schedule->execute("DELETE FROM schedules WHERE lecturer_id = $id");
        $schedule->close();

        //hapus lecturer
        $this->lecturer->open();
        $this->lecturer->delete($id);
        $this->lecturer->close();

        // 3. Redirect kembali
        header("Location: /tp_mvc25/lecturers.php");
        exit;
    }

}