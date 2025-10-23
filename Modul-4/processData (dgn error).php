<?php
require 'validate.inc.php';

$errors = [];

// Validasi dengan detail error
if (!validateNameWithError($_POST, 'surname', $errors)) {
    echo "Data invalid! Errors:<br>";
    foreach ($errors as $field => $error) {
        echo "- $field: $error<br>";
    }
} else {
    echo 'Data OK!';
}

// Tampilkan data yang diterima
echo "<pre>";
print_r($_POST);
echo "</pre>";
?>