<?php
// Mendefinisikan function dengan nilai default parameter

function setHeight($minHeight = 50) {
    echo "Tingginya adalah : $minHeight <br>";
}

// Panggil function tanpa input nilai parameter
setHeight();

setHeight(450);
setHeight(135);
?>