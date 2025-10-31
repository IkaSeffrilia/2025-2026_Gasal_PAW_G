<?php
include 'koneksi.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('ID supplier tidak valid'); window.location.href = 'index.php';</script>";
    exit;
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// Hapus data dari database
$sql = "DELETE FROM supplier WHERE id = $id";

if (mysqli_query($koneksi, $sql)) {
    echo "<script>alert('Data berhasil dihapus'); window.location.href = 'index.php';</script>";
} else {
    echo "<script>alert('Error: " . mysqli_error($koneksi) . "'); window.location.href = 'index.php';</script>";
}

mysqli_close($koneksi);
?>