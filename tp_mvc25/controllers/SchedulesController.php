<?php
// Memuat konfigurasi, model schedules, lecturers, dan semua view yang dibutuhkan
include_once(__DIR__ . "/../config.php");
include_once(__DIR__ . "/../models/Schedules.php");
include_once(__DIR__ . "/../models/Lecturers.php");
include_once(__DIR__ . "/../views/SchedulesView.php");
include_once(__DIR__ . "/../views/SchedulesAddView.php");
include_once(__DIR__ . "/../views/SchedulesEditView.php");

class SchedulesController
{
    private $schedule;  // model schedules
    private $lecturer;  // model lecturers

    // Membangun objek model ketika controller dibuat
    function __construct()
    {
        $this->schedule = new Schedules(
            Config::$db_host,
            Config::$db_user,
            Config::$db_pass,
            Config::$db_name
        );

        $this->lecturer = new Lecturers(
            Config::$db_host,
            Config::$db_user,
            Config::$db_pass,
            Config::$db_name
        );
    }

    // Menampilkan daftar schedule
    public function index()
    {
        // Mengambil seluruh jadwal (JOIN tabel lecturers)
        $scheduleData = $this->schedule->getAll();

        // Mengambil daftar lecturer untuk kebutuhan dropdown
        $lecturerData = $this->lecturer->getAll();

        // Menampilkan halaman lewat view
        $view = new SchedulesView();
        $view->render([
            "schedules" => $scheduleData,
            "lecturers" => $lecturerData
        ]);
    }

    // Menampilkan form tambah atau memproses tambah jadwal
    public function add()
    {
        // Jika form belum disubmit → tampilkan form
        if (!isset($_POST['submit'])) {

            // Data lecturer untuk dropdown
            $lecturerData = $this->lecturer->getAll();

            // Tampilkan view add
            $view = new SchedulesAddView();
            $view->render($lecturerData);

        } else {

            // Menambahkan data ke database
            $this->schedule->create(
                $_POST['lecturer_id'],
                $_POST['day'],
                $_POST['time_start'],
                $_POST['time_end']
            );

            // Redirect setelah sukses
            header("Location: /tp_mvc25/schedules.php");
            exit;
        }
    }

    // Menampilkan form edit atau memproses update jadwal
    public function edit()
    {
        $id = $_GET['id']; // id schedule

        // Jika belum submit → tampilkan form edit
        if (!isset($_POST['submit'])) {

            // Ambil data schedule untuk pre-fill form
            $scheduleData = $this->schedule->getById($id);

            // Ambil data lecturer untuk dropdown
            $lecturerData = $this->lecturer->getAll();

            // Tampilkan halaman edit
            $view = new SchedulesEditView();
            $view->render($scheduleData, $lecturerData);

        } else {

            // Update data
            $this->schedule->update(
                $id,
                $_POST['lecturer_id'],
                $_POST['day'],
                $_POST['time_start'],
                $_POST['time_end']
            );

            // Redirect setelah update
            header("Location: /tp_mvc25/schedules.php");
            exit;
        }
    }

    // Menghapus jadwal berdasarkan id
    public function delete()
    {
        $id = $_GET['id'];

        // Hapus data
        $this->schedule->open();
        $this->schedule->delete($id);
        $this->schedule->close();

        // Redirect
        header("Location: /tp_mvc25/schedules.php");
    }
}