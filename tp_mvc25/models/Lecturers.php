<?php
include_once("DB.php");

class Lecturers extends DB
{
    // Mengambil semua data lecturers + join nama departemen
    function getAll()
    {
        $this->open(); // buka koneksi ke database

        // LEFT JOIN agar lecturer tetap muncul meskipun tidak punya department_id
        $query = "SELECT l.*, d.department_name 
                  FROM lecturers l
                  LEFT JOIN departments d ON l.department_id = d.id";

        $this->execute($query);

        $data = [];

        // Mengambil semua baris hasil query sebagai array
        while ($row = $this->getResult()) {
            $data[] = $row;
        }

        $this->close(); // tutup koneksi
        return $data;   // kembalikan array berisi semua data lecturer
    }

    // Mengambil data lecturer berdasarkan ID (1 baris saja)
    function getById($id)
    {
        $this->open(); // buka koneksi

        $query = "SELECT * FROM lecturers WHERE id=$id";
        $this->execute($query);

        $data = $this->getResult(); // ambil 1 baris hasil query

        $this->close(); // tutup koneksi
        return $data;   // return associative array
    }

    // Menambah data lecturer baru ke database
    function create($name, $nidn, $phone, $join_date, $department_id)
    {
        $this->open();

        $query = "INSERT INTO lecturers (name, nidn, phone, join_date, department_id)
                  VALUES ('$name', '$nidn', '$phone', '$join_date', '$department_id')";

        $result = $this->execute($query); // jalankan query INSERT

        $this->close();
        return $result; // true/false
    }

    // Mengupdate data lecturer berdasarkan ID
    function update($id, $name, $nidn, $phone, $join_date, $department_id)
    {
        $this->open();

        $query = "UPDATE lecturers SET
                    name='$name',
                    nidn='$nidn',
                    phone='$phone',
                    join_date='$join_date',
                    department_id='$department_id'
                  WHERE id=$id";

        $result = $this->execute($query); // jalankan UPDATE

        $this->close();
        return $result;
    }

    // Menghapus data lecturer berdasarkan ID
    function delete($id)
    {
        $this->open();

        $query = "DELETE FROM lecturers WHERE id=$id";

        $result = $this->execute($query); // jalankan DELETE

        $this->close();
        return $result;
    }
}