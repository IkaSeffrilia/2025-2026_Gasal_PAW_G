<?php

$host = "Localhost";
$username = "root";
$password = "";
$database = "management_supplier";

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>