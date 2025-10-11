<?php
// 3.6.4. Implementasi fungsi array_search()
echo "<h3> 3.6.4. Fungsi array_search()</h3>";
$colors = ["merah", "hijau", "biru", "kuning", "biru"];

echo "Array colors: ";
print_r($colors);

$search_green = array_search("hijau", $colors);
echo "<br>Pencarian 'hijau': Key = " . $search_green;

$search_blue = array_search("biru", $colors);
echo "<br>Pencarian 'biru': Key = " . $search_blue . " (hanya key pertama)";

$search_orange = array_search("orange", $colors);
echo "<br>Pencarian 'orange': " . ($search_orange === false ? "Tidak ditemukan" : $search_orange);

// Contoh dengan array asosiatif
$ages = ["Andi" => 25, "Budi" => 30, "Citra" => 22];
echo "<br><br>Array ages: ";
print_r($ages);

$search_age_30 = array_search(30, $ages);
echo "<br>Pencarian usia 30: Key = '" . $search_age_30 . "'";
?>