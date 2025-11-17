<?php
include 'Koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Transaksi - Penjualan XYZ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-brand { font-weight: bold; }
        .btn-report { background-color: #28a745; color: white; }
        .btn-report:hover { background-color: #218838; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Penjualan XYZ</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="#">Supplier</a>
                <a class="nav-link" href="#">Barang</a>
                <a class="nav-link active" href="#">Transaksi</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Data Master Transaksi</h2>
        
        <!-- Tombol Lihat Laporan -->
        <div class="mb-3">
            <a href="report_transaksi.php" class="btn btn-report">
                Lihat Laporan Penjualan
            </a>
        </div>

        <!-- Tabel Transaksi -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>ID Transaksi</th>
                        <th>Waktu Transaksi</th>
                        <th>Nama Pelanggan</th>
                        <th>Keterangan</th>
                        <th>Total</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM transaksi ORDER BY waktu_transaksi DESC";
                    $result = mysqli_query($koneksi, $query);
                    $no = 1;
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$no}</td>";
                        echo "<td>{$row['id_transaksi']}</td>";
                        echo "<td>{$row['waktu_transaksi']}</td>";
                        echo "<td>{$row['nama_pelanggan']}</td>";
                        echo "<td>{$row['keterangan']}</td>";
                        echo "<td>Rp" . number_format($row['total'], 0, ',', '.') . "</td>";
                        echo "<td>
                                <button class='btn btn-sm btn-info'>Lihat Detail</button>
                                <button class='btn btn-sm btn-warning'>Edit</button>
                              </td>";
                        echo "</tr>";
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>