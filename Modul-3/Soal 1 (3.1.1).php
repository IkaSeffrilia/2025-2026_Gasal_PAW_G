<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
echo "I like ". $fruits[0] . ", ". $fruits[1] . " and ". $fruits[2] . ".<br><br>";

echo "3.1.1 Tambahkan 5 data baru:<br>";
$fruits[] = "Durian";
$fruits[] = "Mango"; 
$fruits[] = "Pear";
$fruits[] = "Grape";
$fruits[] = "Pineapple";

echo "Array fruits setelah ditambah 5 data: ";
print_r($fruits);
echo "<br>";

$indeks_tertinggi = count($fruits) - 1;
echo "Nilai dengan indeks tertinggi: " . $fruits[$indeks_tertinggi] . "<br>";
echo "Indeks tertinggi: " . $indeks_tertinggi . "<br><br>";
?>