<?php
require 'validate.inc.php';

$errors = [];
$success_message = '';
$form_data = [];

// Inisialisasi data form
$fields = ['surname', 'email', 'phone', 'age'];
foreach ($fields as $field) {
    $form_data[$field] = isset($_POST[$field]) ? htmlspecialchars($_POST[$field]) : '';
}

// Proses form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validasi semua field
    validateNameWithError($_POST, 'surname', $errors);
    validateEmail($_POST, 'email', $errors);
    validatePhone($_POST, 'phone', $errors);
    validateAge($_POST, 'age', $errors);
    
    // Jika tidak ada error
    if (empty($errors)) {
        $success_message = 'Form submitted successfully with no errors';
        // Reset form data setelah submit berhasil
        foreach ($fields as $field) {
            $form_data[$field] = '';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Formulir</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 600px; margin: 0 auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="email"], input[type="number"] { 
            width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; 
        }
        .error { color: red; font-size: 14px; margin-top: 5px; }
        .success { color: green; font-weight: bold; margin-bottom: 15px; }
        .submit-btn { 
            background-color: #007bff; color: white; padding: 10px 20px; 
            border: none; border-radius: 4px; cursor: pointer; 
        }
        .submit-btn:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Input Formulir</h1>
        
        <?php if (!empty($success_message)): ?>
            <div class="success"><?php echo $success_message; ?></div>
        <?php endif; ?>
        
        <?php include 'form.inc.php'; ?>
        
        <?php if (!empty($errors)): ?>
            <div style="margin-top: 20px; padding: 10px; background-color: #f8d7da; border: 1px solid #f5c6cb; border-radius: 4px;">
                <h3>Validation Errors:</h3>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>