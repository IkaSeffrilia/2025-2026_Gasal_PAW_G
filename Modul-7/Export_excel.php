<?php
include 'Koneksi.php';

// Tanggal dari parameter
$tanggal_awal = $_GET['tanggal_awal'] ?? '2023-11-08';
$tanggal_akhir = $_GET['tanggal_akhir'] ?? '2023-11-14';

// Header untuk download file Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"laporan_penjualan.xls\"");
header("Pragma: no-cache");
header("Expires: 0");

// Query data
$query_rekap = "SELECT 
                DATE(waktu_transaksi) as tanggal,
                SUM(total) as total_harian
                FROM transaksi 
                WHERE waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
                GROUP BY DATE(waktu_transaksi)
                ORDER BY tanggal";

$result_rekap = mysqli_query($koneksi, $query_rekap);

// Query total
$query_total = "SELECT 
                COUNT(*) as total_pelanggan,
                SUM(total) as total_pendapatan
                FROM transaksi 
                WHERE waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";

$result_total = mysqli_query($koneksi, $query_total);
$data_total = mysqli_fetch_assoc($result_total);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
    <h2>Rekap Laporan Penjualan <?php echo date('d-m-Y', strtotime($tanggal_awal)); ?> sampai <?php echo date('d-m-Y', strtotime($tanggal_akhir)); ?></h2>
    
    <table border="1">
        <thead>
            <tr style="background-color: #f2f2f2;">
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

    <br>

    <table border="1" width="100%">
        <tr style="background-color: #e9ecef;">
            <th width="50%">Jumlah Pelanggan</th>
            <th width="50%">Jumlah Pendapatan</th>
        </tr>
        <tr>
            <td style="text-align: center; font-size: 16px;"><b><?php echo $data_total['total_pelanggan']; ?> Orang</b></td>
            <td style="text-align: center; font-size: 16px;"><b>Rp<?php echo number_format($data_total['total_pendapatan'], 0, ',', '.'); ?></b></td>
        </tr>
    </table>
</body>
</html>