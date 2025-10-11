<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
echo "I like ". $fruits[0] . ", ". $fruits[1] . " and ". $fruits[2] . ".<br><br>";

echo "3.1.3 Buat array baru Sveggies:<br>";
$veggies = array("Wortel", "Brokoli", "Bayam");
echo "Seluruh data dari array veggies: ";
foreach($veggies as $veggie) {
    echo $veggie . " ";
}
?>