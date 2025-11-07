<?php
include 'koneksi.php';
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .table-responsive {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 bg-primary text-white p-3">
                <h1 class="text-center">Sistem Pengelolaan Transaksi</h1>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h3>Menu Utama</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <a href="form_tambah_transaksi.php" class="btn btn-primary w-100">Tambah Transaksi</a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="Form_Tambah_Detail_Transaksi.php" class="btn btn-info w-100">Tambah Detail Transaksi</a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="#tabel-barang" class="btn btn-secondary w-100">Lihat Barang</a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="#tabel-transaksi" class="btn btn-secondary w-100">Lihat Transaksi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Barang -->
        <div class="row mt-4" id="tabel-barang">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-warning">
                        <h3>Data Barang</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Barang</th>
                                        <th>Harga Satuan</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query_barang = "SELECT * FROM barang";
                                    $result_barang = mysqli_query($koneksi, $query_barang);
                                    
                                    while ($row = mysqli_fetch_assoc($result_barang)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['nama'] . "</td>";
                                        echo "<td>Rp " . number_format($row['harga_satuan'], 0, ',', '.') . "</td>";
                                        echo "<td>" . $row['stok'] . "</td>";
                                        echo "<td>
                                                <a href='hapus_barang.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirmHapus()'>Hapus</a>
                                              </td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Transaksi -->
        <div class="row mt-4" id="tabel-transaksi">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h3>Data Transaksi</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Waktu Transaksi</th>
                                        <th>Pelanggan</th>
                                        <th>Keterangan</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query_transaksi = "SELECT t.*, p.nama as nama_pelanggan 
                                                       FROM transaksi t 
                                                       LEFT JOIN pelanggan p ON t.pelanggan_id = p.id 
                                                       ORDER BY t.waktu_transaksi DESC";
                                    $result_transaksi = mysqli_query($koneksi, $query_transaksi);
                                    
                                    while ($row = mysqli_fetch_assoc($result_transaksi)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . date('d-m-Y H:i', strtotime($row['waktu_transaksi'])) . "</td>";
                                        echo "<td>" . $row['nama_pelanggan'] . "</td>";
                                        echo "<td>" . $row['keterangan'] . "</td>";
                                        echo "<td>Rp " . number_format($row['total'], 0, ',', '.') . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Transaksi Detail -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        <h3>Detail Transaksi</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>ID Transaksi</th>
                                        <th>Barang</th>
                                        <th>Qty</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query_detail = "SELECT td.*, t.waktu_transaksi, b.nama as nama_barang 
                                                   FROM transaksi_detail td 
                                                   JOIN transaksi t ON td.transaksi_id = t.id 
                                                   JOIN barang b ON td.barang_id = b.id 
                                                   ORDER BY t.waktu_transaksi DESC";
                                    $result_detail = mysqli_query($koneksi, $query_detail);
                                    
                                    while ($row = mysqli_fetch_assoc($result_detail)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['transaksi_id'] . "</td>";
                                        echo "<td>" . $row['nama_barang'] . "</td>";
                                        echo "<td>" . $row['qty'] . "</td>";
                                        echo "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmHapus() {
            return confirm("Apakah Anda yakin ingin menghapus barang ini?");
        }
    </script>
</body>
</html>