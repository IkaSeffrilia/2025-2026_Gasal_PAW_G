<?php

include "Koneksi.php";
session_start();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $waktu_transaksi = $_POST['waktu_transaksi'];
    $keterangan = $_POST['keterangan'];
    $pelanggan_id = $_POST['pelanggan_id'];

    // Validasi tanggal tidak kurang hari ini
    $today = date('Y-m-d');
    $input_date = date('Y-m-d', strtotime($waktu_transaksi));
    
    if ($input_date < $today) {
        $error = "Tanggal transaksi tidak boleh kurang dari hari ini!";
    }

    // Validasi panjang keterangan minimal 3 karakter
    elseif (strlen(trim($keterangan)) < 3) {
        $error = "Keterangan harus minimal 3 karakter!";
    } else {
        // Simpan data transaksi 
        $query = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES (?, ?, 0, ?)";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "ssi", $waktu_transaksi, $keterangan, $pelanggan_id);

        if (mysqli_stmt_execute($stmt)) {
            $success = "Data transaksi berhasil ditambahkan!";
            $_POST = array(); // Reset form
        } else {
            $error = "Gagal menambahkan data transaksi: " . mysqli_error($koneksi);
        }
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
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
            <div class="card-header bg-primary text-white">
                <h2 class="text-center">Tambah Data Transaksi</h2>
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
                        <label for="waktu_transaksi" class="form-label">Waktu Transaksi</label>
                        <input type="datetime-local" class="form-control" id="waktu_transaksi" 
                               name="waktu_transaksi" value="<?php echo date('Y-m-d\TH:i'); ?>" required>
                        <div class="form-text">Tanggal tidak boleh kurang dari hari ini.</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="pelanggan_id" class="form-label">Pelanggan</label>
                        <select class="form-select" id="pelanggan_id" name="pelanggan_id" required>
                            <option value="">Pilih Pelanggan</option>
                            <?php
                            $query_pelanggan = "SELECT * FROM pelanggan ORDER BY nama";
                            $result_pelanggan = mysqli_query($koneksi, $query_pelanggan);
                            
                            while ($row = mysqli_fetch_assoc($result_pelanggan)) {
                                echo "<option value='" . $row['id'] . "'>" . $row['nama'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" 
                                  rows="3" minlength="3" required><?php echo isset($_POST['keterangan']) ? $_POST['keterangan'] : ''; ?></textarea>
                        <div class="form-text">Minimal 3 karakter.</div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                        <a href="index.php" class="btn btn-secondary">Kembali ke Halaman Utama</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>