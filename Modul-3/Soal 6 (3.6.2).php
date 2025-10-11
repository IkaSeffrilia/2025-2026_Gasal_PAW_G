<?php
// 3.6.2. Implementasi fungsi array_merge()
echo "<h3> 3.6.2. Fungsi array_merge()</h3>";
$array1 = ["a" => "merah", "b" => "hijau"];
$array2 = ["c" => "biru", "b" => "kuning"];
$array3 = [1, 2, 3];

echo "Array 1: ";
print_r($array1);
echo "<br>Array 2: ";
print_r($array2);
echo "<br>Array 3: ";
print_r($array3);

$merged = array_merge($array1, $array2, $array3);
echo "<br>Hasil array_merge(): ";
print_r($merged);
?>