<?php
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");

unset($height["Barry"]);

echo "Setelah menghapus data Barry:<br>";
$last_value = end($height);
$last_key = key($height);
echo "Nilai terakhir: $last_key => $last_value<br><br>";
?>