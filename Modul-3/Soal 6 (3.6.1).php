<?php
// 3.6.1. Implementasi fungsi array_push()
echo "<h3> 3.6.1. Fungsi array_push()</h3>";
$fruits = ["Apel", "Jeruk", "Mangga"];
echo "Array sebelum array_push(): ";
print_r($fruits);

array_push($fruits, "Pisang", "Anggur", "Semangka");
echo "<br>Array setelah array_push(): ";
print_r($fruits);
?>