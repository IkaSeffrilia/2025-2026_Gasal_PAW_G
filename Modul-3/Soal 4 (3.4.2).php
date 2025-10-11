<?php
$weight = array(
    "Andy" => "70",
    "Barry" => "65", 
    "Charlie" => "68"
);

echo "<h3>Data Weight (Menggunakan for):</h3>";
$keys = array_keys($weight);
for($i = 0; $i < count($weight); $i++) {
    echo "Kata kunci: " . $keys[$i] . ", Nilai: " . $weight[$keys[$i]] . "<br>";
}
?>