<?php
$weight = array("Andy" => "65", "Barry" => "70", "Charlie" => "68");

echo "Data ke-2 dalam array weight:<br>";
$keys = array_keys($weight);
echo "Key: " . $keys[1] . ", Nilai: " . $weight[$keys[1]];
?>