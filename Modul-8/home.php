<?php
include 'cek_session.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Sistem POS</title>
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
    </style>
</head>
<body>
    <div class="navbar">
        <a href="home.php">Home</a>
        
        <?php if ($_SESSION['level'] == 1): ?>
            <!-- Menu untuk Owner (Level 1) -->
            <a href="data_master.php">Data Master</a>
        <?php endif; ?>
        
        <a href="transaksi.php">Transaksi</a>
        <a href="laporan.php">Laporan</a>
        
        <div class="user-info">
            <?php echo $_SESSION['nama']; ?> | 
            <a href="Logout.php" style="color: #ffcc00;">Logout</a>
        </div>
    </div>
    
    <div class="content">
        <h1>Selamat Datang di Sistem POS</h1>
        <p>Halo, <?php echo $_SESSION['nama']; ?>! Anda login sebagai 
           <?php echo ($_SESSION['level'] == 1) ? 'Owner' : 'Kasir'; ?>.</p>
    </div>
</body>
</html>