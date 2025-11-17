# TP8DPBO2425C1
## Janji

Saya Dhiya Ulhaq dengan NIM 2407716 Mengerjakan Tugas Praktikum 8 (MVC) dalam Mata Kuliah Desain Pemrograman Berorientasi Objek untuk Keberkahan-Nya Maka Saya Tidak Akan Melakukan Kecurangan Seperti Yang Telah di Spesifikasikan. Aamiin

## Penjelasan Desain Program

**Education Campus System** merupakan sistem untuk mengelola data universitas yang dibangun menggunakan arsitektur MVC (Model–View–Controller). Sistem ini digunakan untuk mengelola tiga entitas utama:
- Departments (Departemen)
- Lecturers (Dosen)
- Schedules (Jadwal)

Setiap bagian memiliki fitur lengkap: menampilkan data (**Read**), menambah (**Create**), mengubah (**Update**), menghapus (**Delete**). Konsep MVC dalam program ini, diantaranya:

1. Model

    Berisi semua class yang berhubungan dengan database.

    `DB.php` : kelas dasar untuk koneksi database.

    `Lecturers.php` : operasi CRUD tabel lecturers.

    `Departments.php` : operasi CRUD tabel departments.

    `Schedules.php` : operasi CRUD tabel schedules.

    Model ini bertugas untuk memproses query SQL, mengambil dan mengembalikan data, tidak pernah berurusan dengan tampilan.
2. View

    Berfungsi untuk mengolah data yang dikirim controller serta menggantikan placeholder seperti `DATA_TABLE`, `DATA_NAME`. Namun, untuk tampilan dipisahkan ke dalam folder **templates** yang berisikan file HTML yang dapat mengatur layout, desain, dan format tampilan.
3. Controller

    Berisi kontrol utama aplikasi untuk setiap entitas, yaitu:
    `LecturersController.php`
    `DepartmentsController.php`
    `SchedulesController.php`

    Bertugas untuk menerima request pengguna (**GET/POST**), mengambil atau mengirim data ke `Model`, dan menentukan `View` mana yang dirender.

    Terdapat 3 tabel beserta atribut pada database, diantaranya:
    1. **Tabel `departments`**

        Berfungsi untuk menyimpan data departemen di sebuah universitas.

        `id` : ID unik departemen

        `department_name` : Nama departemen

        `location` : Lokasi gedung

        `email` : Email resmi departemen

    2. **Tabel `lecturers`**

        Berfungsi untuk menyimpan data dosen yang berada di departemen. Sehingga relasinya `1 department → banyak lecturers`.

        `id` : ID unik dosen

        `name` : Nama dosen

        `nidn` : Nomor induk

        `phone` : Nomor telepon

        `join_date` : Tanggal bergabung

        `department_id` : Relasi ke `departments`

    3. **Tabel `schedules`**

        Berfungsi untuk menyimpan data jadwal untuk satu dosen. Sehingga relasinya `1 lecturer → banyak schedules`.

        `id` : ID unik jadwal

        `lecturer_id` : Dosen yang mengajar

        `day` : Hari mengajar

        `time_start` : Jam mulai

        `time_end` : Jam selesai

## Penjelasan Alur Program

### a. Pengguna Membuka Halaman
Setiap halaman utama seperti, `lecturers.php`, `departments.php`, `schedules.php`.

```php
include_once("controllers/LecturersController.php");
$controller = new LecturersController();
$controller->index();
```
User membuka halaman agar memanggil `Controller` dan dapat dilanjut memanggil `Model` dan `View`.

### b. Controller Menjalankan Logikanya
Contoh pada `LecturersController.php` terdapat `index()`, `add()`, `edit()`, `delete()`. Controller akan memanggil `Model` untuk mengambil data dari database, mempersiapkan data dalam bentuk array, memanggil View untuk menampilkan UI.

### c. Model Mengakses Database
```java
class Lecturers extends DB { ... }
```
Model mewarisi `DB.php`, sehingga model dapat melakukakn `open()`, `execute(query)`, `getResult()`, `close()` untuk mengelola database.

### d. Controller Mengirim Data ke View
```php
$view = new LecturersView();
$view->render([
    "lecturers" => $lecturerData,
    "departments" => $departmentData
]);
```
Setelah model mengembalikan array data, controller memasukkannya ke View.

### e. View PHP Memproses Data
```php
$view->replace("DATA_TABLE", $tableHTML);
```
View memproses data yang akan disiapkan sebagai HTML.

## Dokumentasi