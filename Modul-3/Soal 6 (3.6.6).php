<?php
// 3.6.6. Implementasi berbagai fungsi sorting
echo "<h3> 3.6.6. Fungsi-Fungsi Sorting Array</h3>";

$data = [40, 100, 1, 5, 25, 10];
echo "Array awal: ";
print_r($data);

// sort() - Ascending
$asc_data = $data;
sort($asc_data);
echo "<br><br>sort() - Ascending: ";
print_r($asc_data);

// rsort() - Descending
$desc_data = $data;
rsort($desc_data);
echo "<br>rsort() - Descending: ";
print_r($desc_data);

// asort() - Ascending dengan menjaga key
$assoc_data = ["b" => 40, "a" => 100, "d" => 1, "c" => 25];
echo "<br><br>Array asosiatif awal: ";
print_r($assoc_data);

$asort_data = $assoc_data;
asort($asort_data);
echo "<br>asort() - Ascending (jaga key): ";
print_r($asort_data);

// arsort() - Descending dengan menjaga key
$arsort_data = $assoc_data;
arsort($arsort_data);
echo "<br>arsort() - Descending (jaga key): ";
print_r($arsort_data);

// ksort() - Sorting berdasarkan key ascending
$ksort_data = $assoc_data;
ksort($ksort_data);
echo "<br>ksort() - Sorting by key ascending: ";
print_r($ksort_data);

// krsort() - Sorting berdasarkan key descending
$krsort_data = $assoc_data;
krsort($krsort_data);
echo "<br>krsort() - Sorting by key descending: ";
print_r($krsort_data);

// Contoh tambahan dengan array string
$names = ["Zaki", "Budi", "Andi", "Citra"];
echo "<br><br>Array names awal: ";
print_r($names);

sort($names);
echo "<br>sort() pada string: ";
print_r($names);

rsort($names);
echo "<br>rsort() pada string: ";
print_r($names);

?>