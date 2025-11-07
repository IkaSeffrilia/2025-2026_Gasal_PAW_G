<?php
include 'Koneksi.php';
session_start();

if (!isset($_GET['id'])) {
    header('Location: Index.php');
    exit();
}

$id = $_GET['id'];

// Validasi apakah barang sudah digunakan dalam transaksi_detail
$query_cek = "SELECT * FROM transaksi_detail WHERE barang_id = ?";
$stmt_cek = mysqli_prepare($koneksi, $query_cek);
mysqli_stmt_bind_param($stmt_cek, "i", $id);
mysqli_stmt_execute($stmt_cek);
$result_cek = mysqli_stmt_get_result($stmt_cek);

if (mysqli_num_rows($result_cek) > 0) {
    // Barang sudah digunakan, tampilkan alert
    echo "<script>
            alert('Barang tidak dapat dihapus karena sudah digunakan dalam transaksi!');
            window.location.href = 'Index.php';
          </script>";
} else {
    // Barang belum digunakan, bisa dihapus
    $query_hapus = "DELETE FROM barang WHERE id = ?";
    $stmt_hapus = mysqli_prepare($koneksi, $query_hapus);
    mysqli_stmt_bind_param($stmt_hapus, "i", $id);
    
    if (mysqli_stmt_execute($stmt_hapus)) {
        echo "<script>
                alert('Barang berhasil dihapus!');
                window.location.href = 'Index.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus barang: " . mysqli_error($koneksi) . "');
                window.location.href = 'Index.php';
              </script>";
    }
    mysqli_stmt_close($stmt_hapus);
}

mysqli_stmt_close($stmt_cek);
mysqli_close($koneksi);
?>