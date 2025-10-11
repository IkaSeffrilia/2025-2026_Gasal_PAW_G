<?php
echo "<h3> 3.6.3. Fungsi array_values()</h3>";
$student = [
    "nama" => "Budi",
    "nim" => "220401",
    "jurusan" => "Informatika",
    "ipk" => 3.75
];

echo "Array asosiatif asli: ";
print_r($student);

$values_only = array_values($student);
echo "<br>Hasil array_values(): ";
print_r($values_only);
?>