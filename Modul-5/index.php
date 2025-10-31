<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Supplier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1200px;
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
        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin: 5px;
            font-size: 14px;
        }
        .btn-tambah {
            background-color: #4CAF50;
            color: white;
        }
        .btn-edit {
            background-color: #2196F3;
            color: white;
        }
        .btn-hapus {
            background-color: #f44336;
            color: white;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 300px;
            border-radius: 5px;
        }
        .modal-buttons {
            text-align: right;
            margin-top: 20px;
        }
        .btn-confirm {
            background-color: #f44336;
            color: white;
        }
        .btn-cancel {
            background-color: #ccc;
            color: black;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Data Master Supplier</h1>
        
        <a href="tambah.php" class="btn btn-tambah">Tambah Data</a>
        
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Telp</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksi.php';
                
                $query = "SELECT * FROM supplier";
                $result = mysqli_query($koneksi, $query);
                
                if (!$result) {
                    echo "<tr><td colspan='5'>Error: " . mysqli_error($koneksi) . "</td></tr>";
                } else {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $no . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['telp']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
                        echo "<td>";
                        echo "<a href='edit.php?id=" . $row['id'] . "' class='btn btn-edit'>Edit</a>";
                        echo "<button class='btn btn-hapus' onclick='konfirmasiHapus(" . $row['id'] . ")'>Hapus</button>";
                        echo "</td>";
                        echo "</tr>";
                        $no++;
                    }
                    
                    if ($no == 1) {
                        echo "<tr><td colspan='5'>Tidak ada data supplier</td></tr>";
                    }
                }
                
                mysqli_close($koneksi);
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="modalHapus" class="modal">
        <div class="modal-content">
            <h3>Konfirmasi Hapus</h3>
            <p>Apakah Anda yakin ingin menghapus data ini?</p>
            <div class="modal-buttons">
                <button id="btnCancel" class="btn btn-cancel">Batal</button>
                <button id="btnConfirm" class="btn btn-confirm">Hapus</button>
            </div>
        </div>
    </div>

    <script>
        let idHapus = 0;
        
        function konfirmasiHapus(id) {
            idHapus = id;
            document.getElementById('modalHapus').style.display = 'block';
        }
        
        document.getElementById('btnCancel').addEventListener('click', function() {
            document.getElementById('modalHapus').style.display = 'none';
        });
        
        document.getElementById('btnConfirm').addEventListener('click', function() {
            window.location.href = 'hapus.php?id=' + idHapus;
        });
        
        // Tutup modal jika klik di luar konten modal
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('modalHapus');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        });
    </script>
</body>
</html>