<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
echo "I like ". $fruits[0] . ", ". $fruits[1] . " and ". $fruits[2] . ".<br><br>";

echo "3.1.2 Hapus 1 data tertentu:<br>";
unset($fruits[2]); 
echo "Array fruits setelah dihapus 1 data: ";
print_r($fruits);
echo "<br>";

$keys = array_keys($fruits);
$indeks_tertinggi_baru = end($keys);
echo "Nilai dengan indeks tertinggi: " . $fruits[$indeks_tertinggi_baru] . "<br>";
echo "Indeks tertinggi: " . $indeks_tertinggi_baru . "<br><br>";
?>