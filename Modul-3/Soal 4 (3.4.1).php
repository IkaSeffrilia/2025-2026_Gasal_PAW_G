<?php
$height = array(
    "Andy"=>"176", 
    "Barry"=>"165", 
    "Charlie"=>"170",
    "David"=>"180",     
    "Eva"=>"162",       
    "Frank"=>"175",     
    "Grace"=>"168",    
    "Henry"=>"172"      
);

echo "<h3>Data Height (menggunakan foreach):</h3>";
foreach($height as $x => $x_value) {
    echo "Kata kunci: " . $x . ", Nilai: " . $x_value . "<br>";
}
?>