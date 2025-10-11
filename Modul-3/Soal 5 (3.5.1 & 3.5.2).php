<?php
$students = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665"),

    array("David", "220404", "0812345654"),
    array("Eva", "220405", "0812345643"),
    array("Frank", "220406", "0812345632"),
    array("Grace", "220407", "0812345621"),
    array("Harry", "220408", "0812345610")
);

for ($row = 0; $row < count($students); $row++) {
    echo "<p><b>Nomor baris ke- $row</b></p>";
    echo "<ul>";
    for ($col = 0; $col < 3; $col++) {
        echo "<li>" . $students[$row][$col] . "</li>";
    }
    echo "</ul>";
}
?>