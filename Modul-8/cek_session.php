<?php

session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Jika user sudah login tapi mencoba akses halaman login, redirect ke home
$current_page = basename($_SERVER['PHP_SELF']);
if ($current_page == 'login.php') {
    header("Location: home.php");
    exit();
}
?>