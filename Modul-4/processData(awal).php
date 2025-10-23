<?php
require 'validate.inc.php';

// Validasi pada data yang diproses
if (validateName($_POST, 'surname')) {
    echo 'Data OK!';
} else {
    echo 'Data invalid!';
}

// Tampilkan data yang diterima
echo "<pre>";
print_r($_POST);
echo "</pre>";
?>