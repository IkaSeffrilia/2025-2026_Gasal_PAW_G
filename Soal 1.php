<?php
$Matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];
$Praktikum = ["JARKOM", "PAW"];
for ($i = 0; $i < count($Matkul); $i++) {
    $nama_matkul = $Matkul[$i];
    $status = "";
    if (in_array($nama_matkul, $Praktikum)) {
        $status = "Saya sedang mengambil matkul $nama_matkul termasuk praktikumnya";
    } elseif ($i == 6 || $i == 7) {
        $status = "Saya belum mengambil matkul $nama_matkul";
    } else {
        $status = "Saya sudah mengambil matkul $nama_matkul semester lalu";
    }
    echo $status . "<br>"; 
}
?>