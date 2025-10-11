<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
$newFruit = array("Rashberry", "Grape", "Mango", "Orange", "Pear");

for($i = 0; $i < count($newFruit); $i++) {
    array_push($fruits, $newFruit[$i]);
}

// Menghitung panjang array setelah penambahan
$arrlength = count($fruits);

// Menampilkan seluruh data dalam array
echo "<h3>Daftar Buah:</h3>";
for($x = 0; $x < $arrlength; $x++) {
    echo ($x + 1) . ". " . $fruits[$x] . "<br>";
}

// Menampilkan panjang array
echo "<br><strong>Panjang array \$fruits saat ini: " . $arrlength . "</strong>";
?>