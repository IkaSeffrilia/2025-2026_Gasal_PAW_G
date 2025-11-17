<?php
include 'Koneksi.php';

// Tanggal default (8-14 November 2023)
$tanggal_awal = isset($_GET['tanggal_awal']) ? $_GET['tanggal_awal'] : '2023-11-08';
$tanggal_akhir = isset($_GET['tanggal_akhir']) ? $_GET['tanggal_akhir'] : '2023-11-14';

// Query untuk rekap harian
$query_rekap = "SELECT 
                DATE(waktu_transaksi) as tanggal,
                COUNT(*) as jumlah_transaksi,
                SUM(total) as total_harian
                FROM transaksi 
                WHERE waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
                GROUP BY DATE(waktu_transaksi)
                ORDER BY tanggal";

$result_rekap = mysqli_query($koneksi, $query_rekap);

// Query untuk total keseluruhan
$query_total = "SELECT 
                COUNT(*) as total_pelanggan,
                SUM(total) as total_pendapatan
                FROM transaksi 
                WHERE waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";

$result_total = mysqli_query($koneksi, $query_total);
$data_total = mysqli_fetch_assoc($result_total);

// Data untuk chart
$labels = [];
$data_chart = [];

while ($row = mysqli_fetch_assoc($result_rekap)) {
    $labels[] = date('d-M-y', strtotime($row['tanggal']));
    $data_chart[] = $row['total_harian'];
}

// Reset pointer untuk digunakan lagi di tabel
mysqli_data_seek($result_rekap, 0);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - Penjualan XYZ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .navbar-brand { font-weight: bold; }
        .card { margin-bottom: 20px; }
        .btn-export { margin-right: 10px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Penjualan XYZ</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="#">Supplier</a>
                <a class="nav-link" href="#">Bizang</a>
                <a class="nav-link active" href="#">Transaksi</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Laporan Penjualan</h2>
        
        <!-- Tombol Kembali -->
        <a href="data_transaksi.php" class="btn btn-secondary mb-3">← Kembali</a>

        <!-- Form Filter -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Filter Laporan</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
                            <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" 
                                   value="<?php echo $tanggal_awal; ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                            <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" 
                                   value="<?php echo $tanggal_akhir; ?>" required>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary">Tampilkan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tombol Export -->
        <div class="mb-3">
            <button onclick="cetakPDF()" class="btn btn-danger btn-export">Cetak PDF</button>
            <button onclick="exportExcel()" class="btn btn-success btn-export">Export Excel</button>
        </div>

        <!-- Grafik -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Grafik Penjualan</h5>
            </div>
            <div class="card-body">
                <canvas id="grafikPenjualan" height="100"></canvas>
            </div>
        </div>

        <!-- Tabel Rekap -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Rekap Harian</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Total</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result_rekap)) {
                                echo "<tr>";
                                echo "<td>{$no}</td>";
                                echo "<td>Rp" . number_format($row['total_harian'], 0, ',', '.') . "</td>";
                                echo "<td>" . date('d-M-y', strtotime($row['tanggal'])) . "</td>";
                                echo "</tr>";
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Total -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Total Keseluruhan</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h5>Jumlah Pelanggan</h5>
                                <h3 class="text-primary"><?php echo $data_total['total_pelanggan']; ?> Orang</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h5>Jumlah Pendapatan</h5>
                                <h3 class="text-success">Rp<?php echo number_format($data_total['total_pendapatan'], 0, ',', '.'); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Grafik
        const ctx = document.getElementById('grafikPenjualan').getContext('2d');
        const grafikPenjualan = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Total Penjualan (Rp)',
                    data: <?php echo json_encode($data_chart); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Rp' + context.parsed.y.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                            }
                        }
                    }
                }
            }
        });

        // Fungsi Export
        function cetakPDF() {
            window.open('export_pdf.php?tanggal_awal=<?php echo $tanggal_awal; ?>&tanggal_akhir=<?php echo $tanggal_akhir; ?>', '_blank');
        }

        function exportExcel() {
            window.open('export_excel.php?tanggal_awal=<?php echo $tanggal_awal; ?>&tanggal_akhir=<?php echo $tanggal_akhir; ?>', '_blank');
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>