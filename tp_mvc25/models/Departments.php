<?php
include_once("DB.php");

class Departments extends DB
{
    // Mengambil semua data departemen (SELECT *)
    function getAll()
    {
        $this->open(); // buka koneksi
        $query = "SELECT * FROM departments";
        $this->execute($query);

        $data = [];

        // Ambil semua hasil query sebagai array
        while ($row = $this->getResult()) {
            $data[] = $row;
        }

        $this->close(); // tutup koneksi
        return $data;   // return array berisi semua baris
    }

    // Mengambil data departemen berdasarkan ID (1 baris)
    function getById($id)
    {
        $this->open();
        $query = "SELECT * FROM departments WHERE id=$id";
        $this->execute($query);

        $data = $this->getResult(); // mengambil 1 baris hasil query

        $this->close();
        return $data; // return associative array berisi 1 data
    }

    // Menambahkan data departemen baru
    function create($name, $location, $email)
    {
        $this->open();

        $query = "INSERT INTO departments (department_name, location, email)
                  VALUES ('$name', '$location', '$email')";

        $result = $this->execute($query);

        $this->close();
        return $result; // true/false status eksekusi query
    }

    // Mengupdate data departemen berdasarkan ID
    function update($id, $name, $location, $email)
    {
        $this->open();

        $query = "UPDATE departments SET 
                    department_name='$name',
                    location='$location',
                    email='$email'
                  WHERE id=$id";

        $result = $this->execute($query);

        $this->close();
        return $result;
    }

    // Menghapus data departemen berdasarkan ID
    function delete($id)
    {
        $this->open();

        $query = "DELETE FROM departments WHERE id=$id";

        $result = $this->execute($query);

        $this->close();
        return $result;
    }
}