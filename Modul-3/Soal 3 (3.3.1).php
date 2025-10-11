<?php
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");

// Soal 3.3.1 - Menambah 5 data baru dan tampilkan indeks terakhir
$height["Diana"] = "160";
$height["Bagas"] = "175";
$height["Fiona"] = "168";
$height["Nayzhiva"] = "180";
$height["Hannah"] = "162";

echo "Setelah penambahan 5 data:<br>";
$last_value = end($height);
$last_key = key($height);
echo "Nilai terakhir: $last_key => $last_value<br><br>";
?>