<?php
include 'Koneksi.php';
session_start();

$error = '';
$success = '';

// Ambil daftar barang yang tersedia (belum digunakan dalam transaksi ini)
$barang_tersedia = array();
$query_barang = "SELECT * FROM barang ORDER BY nama";
$result_barang = mysqli_query($koneksi, $query_barang);
while ($row = mysqli_fetch_assoc($result_barang)) {
    $barang_tersedia[$row['id']] = $row;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $transaksi_id = $_POST['transaksi_id'];
    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];
    
    // Validasi apakah barang sudah digunakan dalam transaksi ini
    $query_cek = "SELECT * FROM transaksi_detail WHERE transaksi_id = ? AND barang_id = ?";
    $stmt_cek = mysqli_prepare($koneksi, $query_cek);
    mysqli_stmt_bind_param($stmt_cek, "ii", $transaksi_id, $barang_id);
    mysqli_stmt_execute($stmt_cek);
    $result_cek = mysqli_stmt_get_result($stmt_cek);
    
    if (mysqli_num_rows($result_cek) > 0) {
        $error = "Barang ini sudah digunakan dalam transaksi ini!";
    } else {
        // Ambil harga satuan barang
        $harga_satuan = $barang_tersedia[$barang_id]['harga_satuan'];
        $harga_total = $harga_satuan * $qty;
        
        // Simpan detail transaksi
        $query = "INSERT INTO transaksi_detail (transaksi_id, barang_id, qty, harga) 
                  VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "iiid", $transaksi_id, $barang_id, $qty, $harga_total);
        
        if (mysqli_stmt_execute($stmt)) {
            // Update total transaksi
            $query_update_total = "UPDATE transaksi t 
                                  SET total = (SELECT SUM(harga) FROM transaksi_detail WHERE transaksi_id = ?) 
                                  WHERE id = ?";
            $stmt_update = mysqli_prepare($koneksi, $query_update_total);
            mysqli_stmt_bind_param($stmt_update, "ii", $transaksi_id, $transaksi_id);
            mysqli_stmt_execute($stmt_update);
            mysqli_stmt_close($stmt_update);
            
            $success = "Detail transaksi berhasil ditambahkan!";
            $_POST = array(); // Reset form
        } else {
            $error = "Gagal menambahkan detail transaksi: " . mysqli_error($koneksi);
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_stmt_close($stmt_cek);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Detail Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 600px;
            margin-top: 20px;
        }
        .card {
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h2 class="text-center">Tambah Detail Transaksi</h2>
            </div>
            <div class="card-body">
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="transaksi_id" class="form-label">Transaksi</label>
                        <select class="form-select" id="transaksi_id" name="transaksi_id" required>
                            <option value="">Pilih Transaksi</option>
                            <?php
                            $query_transaksi = "SELECT t.*, p.nama as nama_pelanggan 
                                               FROM transaksi t 
                                               LEFT JOIN pelanggan p ON t.pelanggan_id = p.id 
                                               ORDER BY t.waktu_transaksi DESC";
                            $result_transaksi = mysqli_query($koneksi, $query_transaksi);
                            
                            while ($row = mysqli_fetch_assoc($result_transaksi)) {
                                echo "<option value='" . $row['id'] . "'>" . 
                                     "Transaksi #" . $row['id'] . " - " . 
                                     date('d/m/Y H:i', strtotime($row['waktu_transaksi'])) . 
                                     " (" . $row['nama_pelanggan'] . ")</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="barang_id" class="form-label">Barang</label>
                        <select class="form-select" id="barang_id" name="barang_id" required>
                            <option value="">Pilih Barang</option>
                            <?php
                            foreach ($barang_tersedia as $id => $barang) {
                                echo "<option value='" . $id . "' data-harga='" . $barang['harga_satuan'] . "'>" . 
                                     $barang['nama'] . " - Rp " . number_format($barang['harga_satuan'], 0, ',', '.') . 
                                     "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="qty" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="qty" name="qty" 
                               min="1" value="<?php echo isset($_POST['qty']) ? $_POST['qty'] : 1; ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Harga Satuan</label>
                        <div id="harga-satuan" class="form-control-plaintext">Rp 0</div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Total Harga</label>
                        <div id="total-harga" class="form-control-plaintext fw-bold">Rp 0</div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-info text-white">Simpan Detail Transaksi</button>
                        <a href="index.php" class="btn btn-secondary">Kembali ke Halaman Utama</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('barang_id').addEventListener('change', updateHarga);
        document.getElementById('qty').addEventListener('input', updateHarga);
        
        function updateHarga() {
            const barangSelect = document.getElementById('barang_id');
            const qtyInput = document.getElementById('qty');
            const hargaSatuanElement = document.getElementById('harga-satuan');
            const totalHargaElement = document.getElementById('total-harga');
            
            if (barangSelect.value) {
                const hargaSatuan = parseFloat(barangSelect.options[barangSelect.selectedIndex].getAttribute('data-harga'));
                const qty = parseInt(qtyInput.value) || 0;
                const totalHarga = hargaSatuan * qty;
                
                hargaSatuanElement.textContent = 'Rp ' + hargaSatuan.toLocaleString('id-ID');
                totalHargaElement.textContent = 'Rp ' + totalHarga.toLocaleString('id-ID');
            } else {
                hargaSatuanElement.textContent = 'Rp 0';
                totalHargaElement.textContent = 'Rp 0';
            }
        }
        
        // Panggil sekali saat halaman dimuat
        updateHarga();
    </script>
</body>
</html>