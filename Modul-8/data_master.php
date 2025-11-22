<?php
include 'cek_session.php';

if ($_SESSION['level'] != 1) {
    header("Location: home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master - Sistem POS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .navbar {
            background-color: #333;
            overflow: hidden;
        }
        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        .user-info {
            float: right;
            color: white;
            padding: 14px 16px;
        }
        .content {
            padding: 20px;
        }
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .menu-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .menu-card a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="home.php">Home</a>
        <a href="data_master.php">Data Master</a>
        <a href="transaksi.php">Transaksi</a>
        <a href="laporan.php">Laporan</a>
        
        <div class="user-info">
            <?php echo $_SESSION['nama']; ?> | 
            <a href="logout.php" style="color: #ffcc00;">Logout</a>
        </div>
    </div>
    
    <div class="content">
        <h1>Data Master</h1>
        
        <div class="menu-grid">
            <div class="menu-card">
                <a href="data_barang.php">Data Barang</a>
            </div>
            <div class="menu-card">
                <a href="data_supplier.php">Data Supplier</a>
            </div>
            <div class="menu-card">
                <a href="data_pelanggan.php">Data Pelanggan</a>
            </div>
            <div class="menu-card">
                <a href="data_user.php">Data User</a>
            </div>
        </div>
    </div>
</body>
</html>