<?php
include 'koneksi.php';

$sql = "CREATE TABLE IF NOT EXISTS supplier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    telp VARCHAR(20) NOT NULL,
    alamat TEXT NOT NULL
)";

if (mysqli_query($koneksi, $sql)) {
    echo "Tabel supplier berhasil dibuat atau sudah ada";
} else {
    echo "Error creating table: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>