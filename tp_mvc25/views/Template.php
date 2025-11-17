<?php

class Template
{
    // Menyimpan nama file template
    var $filename = '';

    // Menyimpan isi file setelah dibaca
    var $content = '';

    // Constructor: membaca file template dari folder /templates
    function __construct($filename = '')
    {
        // Tentukan path file template
        $path = __DIR__ . "/../templates/" . $filename;

        // Jika file template tidak ditemukan → hentikan program
        if (!file_exists($path)) {
            die("Template not found: " . $path);
        }

        // Baca seluruh isi file menjadi satu string
        // file() -> menghasilkan array baris
        // implode() -> menggabungkan menjadi satu string
        $this->content = implode('', file($path));
    }

    // Menghapus placeholder yang belum diganti, misal DATA_ABC
    function clear()
    {
        $this->content = preg_replace("/DATA_[A-Z|_|0-9]+/", "", $this->content);
    }

    // Menampilkan template ke browser
    function write()
    {
        $this->clear();      // hapus placeholder tersisa
        print $this->content; // tampilkan HTML final
    }

    // Mengambil isi template (jika dibutuhkan)
    function getContent()
    {
        $this->clear();
        return $this->content;
    }

    // Mengganti placeholder dengan nilai yang diberikan
    function replace($old = '', $new = '')
    {
        // Tentukan format nilai berdasarkan tipe data
        if (is_int($new)) {
            $value = sprintf("%d", $new);
        } elseif (is_float($new)) {
            $value = sprintf("%f", $new);
        } elseif (is_array($new)) {
            // Jika array, gabungkan menjadi string
            $value = '';
            foreach ($new as $item) {
                $value .= $item . ' ';
            }
        } else {
            // Tipe lain → langsung pakai
            $value = $new;
        }

        // Ganti placeholder di template
        $this->content = preg_replace("/$old/", $value, $this->content);
    }
}