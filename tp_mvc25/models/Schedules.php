<?php
include_once("DB.php");

class Schedules extends DB
{
    // Mengambil semua data jadwal + nama dosen (JOIN lecturers)
    function getAll()
    {
        $this->open(); // buka koneksi database

        // JOIN untuk menampilkan nama dosen di tabel schedules
        $query = "SELECT s.*, l.name AS lecturer_name
                  FROM schedules s
                  JOIN lecturers l ON s.lecturer_id = l.id";

        $this->execute($query);

        $data = [];

        // Ambil semua baris data hasil query
        while ($row = $this->getResult()) {
            $data[] = $row;
        }

        $this->close(); // tutup koneksi
        return $data;   // return array berisi semua schedule
    }

    // Mengambil data schedule berdasarkan id (1 baris)
    function getById($id)
    {
        $this->open();

        $query = "SELECT * FROM schedules WHERE id=$id";
        $this->execute($query);

        $data = $this->getResult(); // ambil 1 baris data

        $this->close();
        return $data;
    }

    // Menambahkan jadwal baru ke database
    function create($lecturer_id, $day, $time_start, $time_end)
    {
        $this->open();

        $query = "INSERT INTO schedules (lecturer_id, day, time_start, time_end)
                  VALUES ('$lecturer_id', '$day', '$time_start', '$time_end')";

        $result = $this->execute($query); // jalankan INSERT

        $this->close();
        return $result; // true/false
    }

    // Mengupdate jadwal berdasarkan id
    function update($id, $lecturer_id, $day, $time_start, $time_end)
    {
        $this->open();

        $query = "UPDATE schedules SET
                    lecturer_id='$lecturer_id',
                    day='$day',
                    time_start='$time_start',
                    time_end='$time_end'
                  WHERE id=$id";

        $result = $this->execute($query); // jalankan UPDATE

        $this->close();
        return $result;
    }

    // Menghapus jadwal berdasarkan id
    function delete($id)
    {
        $this->open();

        $query = "DELETE FROM schedules WHERE id=$id";

        $result = $this->execute($query); // jalankan DELETE

        $this->close();
        return $result;
    }
}