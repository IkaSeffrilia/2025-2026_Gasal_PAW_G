<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Supplier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn-simpan {
            background-color: #4CAF50;
            color: white;
        }
        .btn-batal {
            background-color: #ccc;
            color: black;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
        .success {
            color: green;
            background-color: #e8f5e8;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Data Master Supplier Baru</h1>
        
        <?php
        // Debug: Tampilkan pesan error PHP
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        include 'koneksi.php';
        
        // Cek koneksi
        if (!$koneksi) {
            die("<div class='error'>Koneksi database gagal: " . mysqli_connect_error() . "</div>");
        }
        
        $nama = $telp = $alamat = "";
        $namaErr = $telpErr = $alamatErr = "";
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validasi nama
            if (empty(trim($_POST["nama"]))) {
                $namaErr = "Nama tidak boleh kosong";
            } else {
                $nama = trim($_POST["nama"]);
                // Cek apakah hanya mengandung huruf, spasi, titik dan koma
                if (!preg_match("/^[a-zA-Z ,.]+$/", $nama)) {
                    $namaErr = "Hanya huruf, spasi, titik dan koma yang diperbolehkan";
                } else {
                    $nama = mysqli_real_escape_string($koneksi, $nama);
                }
            }
            
            // Validasi telepon
            if (empty(trim($_POST["telp"]))) {
                $telpErr = "Telepon tidak boleh kosong";
            } else {
                $telp = trim($_POST["telp"]);
                // Cek apakah hanya mengandung angka
                if (!preg_match("/^[0-9]+$/", $telp)) {
                    $telpErr = "Hanya angka yang diperbolehkan";
                } else {
                    $telp = mysqli_real_escape_string($koneksi, $telp);
                }
            }
            
            // Validasi alamat
            if (empty(trim($_POST["alamat"]))) {
                $alamatErr = "Alamat tidak boleh kosong";
            } else {
                $alamat = trim($_POST["alamat"]);
                // Cek apakah mengandung minimal 1 huruf dan 1 angka
                if (!preg_match("/[a-zA-Z]/", $alamat) || !preg_match("/[0-9]/", $alamat)) {
                    $alamatErr = "Alamat harus mengandung minimal 1 huruf dan 1 angka";
                } else {
                    $alamat = mysqli_real_escape_string($koneksi, $alamat);
                }
            }
            
            // Debug: Tampilkan nilai variabel
            echo "<!-- Debug: nama=$nama, telp=$telp, alamat=$alamat -->";
            echo "<!-- Debug: namaErr=$namaErr, telpErr=$telpErr, alamatErr=$alamatErr -->";
            
            // Jika tidak ada error, simpan ke database
            if (empty($namaErr) && empty($telpErr) && empty($alamatErr)) {
                $sql = "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')";
                
                echo "<!-- Debug: SQL = $sql -->";
                
                if (mysqli_query($koneksi, $sql)) {
                    echo "<div class='success'>Data berhasil ditambahkan! Redirecting...</div>";
                    echo "<script>
                            setTimeout(function() {
                                window.location.href = 'index.php';
                            }, 2000);
                          </script>";
                    // Jangan exit dulu, biarkan user melihat pesan sukses
                } else {
                    echo "<div class='error'>Error: " . mysqli_error($koneksi) . "</div>";
                }
            } else {
                echo "<div class='error'>Silakan perbaiki error di bawah ini:</div>";
            }
        }
        ?>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="nama">Nama *</label>
                <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($nama); ?>" 
                       placeholder="Contoh: PT. Maju Jaya">
                <span class="error"><?php echo $namaErr; ?></span>
            </div>
            
            <div class="form-group">
                <label for="telp">Telp *</label>
                <input type="text" id="telp" name="telp" value="<?php echo htmlspecialchars($telp); ?>" 
                       placeholder="Contoh: 08123456789">
                <span class="error"><?php echo $telpErr; ?></span>
            </div>
            
            <div class="form-group">
                <label for="alamat">Alamat *</label>
                <textarea id="alamat" name="alamat" rows="4" 
                          placeholder="Contoh: Jl. Merdeka No. 123"><?php echo htmlspecialchars($alamat); ?></textarea>
                <span class="error"><?php echo $alamatErr; ?></span>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-simpan">Simpan</button>
                <a href="index.php" class="btn btn-batal">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>