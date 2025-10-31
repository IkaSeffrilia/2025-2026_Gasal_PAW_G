<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Supplier</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Data Master Supplier</h1>
        
        <?php
        include 'koneksi.php';
        
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            echo "<div class='error'>ID supplier tidak valid</div>";
            echo "<a href='index.php' class='btn btn-batal'>Kembali</a>";
            exit;
        }
        
        $id = mysqli_real_escape_string($koneksi, $_GET['id']);
        
        // Ambil data supplier berdasarkan ID
        $query = "SELECT * FROM supplier WHERE id = $id";
        $result = mysqli_query($koneksi, $query);
        
        if (!$result || mysqli_num_rows($result) == 0) {
            echo "<div class='error'>Data supplier tidak ditemukan</div>";
            echo "<a href='index.php' class='btn btn-batal'>Kembali</a>";
            exit;
        }
        
        $supplier = mysqli_fetch_assoc($result);
        $id = $supplier['id'];
        $nama = $supplier['nama'];
        $telp = $supplier['telp'];
        $alamat = $supplier['alamat'];
        
        $namaErr = $telpErr = $alamatErr = "";
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validasi nama
            if (empty($_POST["nama"])) {
                $namaErr = "Nama tidak boleh kosong";
            } else {
                $nama = mysqli_real_escape_string($koneksi, $_POST["nama"]);
                // Cek apakah hanya mengandung huruf, spasi, titik dan koma
                if (!preg_match("/^[a-zA-Z ,.]+$/", $nama)) {
                    $namaErr = "Hanya huruf, spasi, titik dan koma yang diperbolehkan";
                }
            }
            
            // Validasi telepon
            if (empty($_POST["telp"])) {
                $telpErr = "Telepon tidak boleh kosong";
            } else {
                $telp = mysqli_real_escape_string($koneksi, $_POST["telp"]);
                // Cek apakah hanya mengandung angka
                if (!preg_match("/^[0-9]+$/", $telp)) {
                    $telpErr = "Hanya angka yang diperbolehkan";
                }
            }
            
            // Validasi alamat
            if (empty($_POST["alamat"])) {
                $alamatErr = "Alamat tidak boleh kosong";
            } else {
                $alamat = mysqli_real_escape_string($koneksi, $_POST["alamat"]);
                // Cek apakah mengandung minimal 1 huruf dan 1 angka
                if (!preg_match("/[a-zA-Z]/", $alamat) || !preg_match("/[0-9]/", $alamat)) {
                    $alamatErr = "Alamat harus mengandung minimal 1 huruf dan 1 angka";
                }
            }
            
            // Jika tidak ada error, update data di database
            if (empty($namaErr) && empty($telpErr) && empty($alamatErr)) {
                $sql = "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat' WHERE id=$id";
                
                if (mysqli_query($koneksi, $sql)) {
                    echo "<script>alert('Data berhasil diupdate'); window.location.href = 'index.php';</script>";
                    exit;
                } else {
                    echo "<div class='error'>Error: " . mysqli_error($koneksi) . "</div>";
                }
            }
        }
        
        mysqli_close($koneksi);
        ?>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $id); ?>">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($nama); ?>">
                <span class="error"><?php echo $namaErr; ?></span>
            </div>
            
            <div class="form-group">
                <label for="telp">Telp</label>
                <input type="text" id="telp" name="telp" value="<?php echo htmlspecialchars($telp); ?>">
                <span class="error"><?php echo $telpErr; ?></span>
            </div>
            
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea id="alamat" name="alamat" rows="4"><?php echo htmlspecialchars($alamat); ?></textarea>
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