<?php

function advancedFormValidation($data) {
    $errors = [];
    $cleaned_data = [];
    
    // 1. String fungsi untuk username
    if (isset($data['username'])) {
        $username = trim($data['username']);
        $username = strtolower($username); // Normalisasi ke lowercase
        $cleaned_data['username'] = $username;
        
        if (empty($username)) {
            $errors['username'] = "Username is required.";
        } elseif (strlen($username) < 3) {
            $errors['username'] = "Username must be at least 3 characters.";
        }
    }
    
    if (isset($data['email'])) {
        $email = trim($data['email']);
        $cleaned_data['email'] = $email;
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email format.";
        }
    }
    
    if (isset($data['website'])) {
        $website = trim($data['website']);
        $cleaned_data['website'] = $website;
        
        if (!empty($website) && !filter_var($website, FILTER_VALIDATE_URL)) {
            $errors['website'] = "Invalid URL format.";
        }
    }
    
    if (isset($data['Gaji'])) {
        $Gaji = trim($data['Gaji']);
        $cleaned_data['Gaji'] = $Gaji;
        
        if (!empty($Gaji)) {
            if (!is_numeric($Gaji)) {
                $errors['Gaji'] = "harus angka.";
            } elseif (floatval($Gaji) < 0) {
                $errors['Gaji'] = "tidak boleh negatif.";
            }
        }
    }
    
    if (isset($data['Tanggal Lahir'])) {
        $TanggalLahir = trim($data['Tanggal Lahir']);
        $cleaned_data['Tangga Lahir'] = $TanggalLahir;
        
        if (!empty($TanggalLahir)) {
            $date_parts = explode('-', $TanggalLahir);
            if (count($date_parts) === 3) {
                list($year, $month, $day) = $date_parts;
                if (!checkdate($month, $day, $year)) {
                    $errors['Tanggal Lahir'] = "Invalid date format.";
                }
            } else {
                $errors['Tanggal Lahir'] = "Tanggal harus dalam format.";
            }
        }
    }
    
    if (isset($data['Kode Pos'])) {
        $Kode_Pos = trim($data['Kode Pos']);
        $cleaned_data['Kode Pos'] = $Kode_Pos;
        
        if (!empty($Kode_Pos)) {
            // Format: 5 digit atau 5-4 digit
            $pattern = "/^\d{5}(-\d{4})?$/";
            if (!preg_match($pattern, $Kode_Pos)) {
                $errors['Kode Pos'] = "Format kode pos tidak valid.";
            }
        }
    }
    
    return ['errors' => $errors, 'cleaned_data' => $cleaned_data];
}

// contoh penggunaan 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = advancedFormValidation($_POST);
    
    if (empty($result['errors'])) {
        echo "<div style='color: green;'>Form validation successful!</div>";
        echo "<pre>Cleaned data: " . print_r($result['cleaned_data'], true) . "</pre>";
    } else {
        echo "<div style='color: red;'>Validation errors found:</div>";
        echo "<ul>";
        foreach ($result['errors'] as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Validasi Formulir Lanjutan</title>
</head>
<body>
    <h2>Validasi Formulir Lanjutan</h2>
    <form method="post">
        <div>
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo $_POST['username'] ?? ''; ?>">
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $_POST['email'] ?? ''; ?>">
        </div>
        <div>
            <label>Website (optional):</label>
            <input type="text" name="website" value="<?php echo $_POST['website'] ?? ''; ?>">
        </div>
        <div>
            <label>Gaji (optional):</label>
            <input type="text" name="Gaji" value="<?php echo $_POST['Gaji'] ?? ''; ?>">
        </div>
        <div>
            <label>Tanggal Lahir (YYYY-MM-DD):</label>
            <input type="text" name="Tanggal Lahir" value="<?php echo $_POST['Tanggal Lahir'] ?? ''; ?>">
        </div>
        <div>
            <label>Kode Pos (optional):</label>
            <input type="text" name="Kode Pos" value="<?php echo $_POST['Kode Pos'] ?? ''; ?>">
        </div>
        <button type="submit">Validasi</button>
    </form>
</body>
</html>