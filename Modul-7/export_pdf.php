<?php
include 'Koneksi.php';

// Tanggal dari parameter
$tanggal_awal = $_GET['tanggal_awal'] ?? '2023-11-08';
$tanggal_akhir = $_GET['tanggal_akhir'] ?? '2023-11-14';


require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// Konfigurasi DOMPDF
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$pdf = new Dompdf($options);

// Konten HTML
$html = '
<style>
    table { border-collapse: collapse; width: 100%; }
    th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    th { background-color: #f2f2f2; }
    .total-row { background-color: #e9ecef; }
</style>
<h1 style="text-align:center;">Rekap Laporan Penjualan</h1>
<h3 style="text-align:center;">' . date('d-m-Y', strtotime($tanggal_awal)) . ' sampai ' . date('d-m-Y', strtotime($tanggal_akhir)) . '</h3>
<br>';

// Query data (sama seperti sebelumnya)
$query_rekap = "SELECT 
                DATE(waktu_transaksi) as tanggal,
                SUM(total) as total_harian
                FROM transaksi 
                WHERE waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
                GROUP BY DATE(waktu_transaksi)
                ORDER BY tanggal";

$result_rekap = mysqli_query($koneksi, $query_rekap);

// Tabel rekap
$html .= '
<table>
    <tr>
        <th width="10%"><b>No</b></th>
        <th width="45%"><b>Total</b></th>
        <th width="45%"><b>Tanggal</b></th>
    </tr>';

$no = 1;
$total_keseluruhan = 0;
$total_pelanggan = 0;

while ($row = mysqli_fetch_assoc($result_rekap)) {
    $html .= '
    <tr>
        <td>' . $no . '</td>
        <td>Rp' . number_format($row['total_harian'], 0, ',', '.') . '</td>
        <td>' . date('d-M-y', strtotime($row['tanggal'])) . '</td>
    </tr>';
    $no++;
    $total_keseluruhan += $row['total_harian'];
}

$html .= '</table><br>';

// Query total pelanggan
$query_pelanggan = "SELECT COUNT(*) as total FROM transaksi WHERE waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
$result_pelanggan = mysqli_query($koneksi, $query_pelanggan);
$data_pelanggan = mysqli_fetch_assoc($result_pelanggan);
$total_pelanggan = $data_pelanggan['total'];

// Total
$html .= '
<table>
    <tr class="total-row">
        <th width="50%"><b>Jumlah Pelanggan</b></th>
        <th width="50%"><b>Jumlah Pendapatan</b></th>
    </tr>
    <tr>
        <td style="text-align:center; font-size:16px;"><b>' . $total_pelanggan . ' Orang</b></td>
        <td style="text-align:center; font-size:16px;"><b>Rp' . number_format($total_keseluruhan, 0, ',', '.') . '</b></td>
    </tr>
</table>';


$pdf->loadHtml($html);
$pdf->setPaper('A4', 'portrait');
$pdf->render();

$pdf->stream('laporan_penjualan.pdf', ['Attachment' => true]);
?>