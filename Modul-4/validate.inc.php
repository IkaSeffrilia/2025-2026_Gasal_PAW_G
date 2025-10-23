<?php
/**
 * Validasi field surname dengan format alfabet
 */

function validateName($field_list, $field_name) {
    if (!isset($field_list[$field_name])) {
        return false;
    }
    $pattern = "/^[a-zA-Z' -]+$/"; // format nama alfabet dengan spasi, tanda petik, tanda hubung
    if (!preg_match($pattern, $field_list[$field_name])) {
        return false;
    }
    return true;
}

/**
 * Versi improved dengan pesan error
 */
function validateNameWithError($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || empty(trim($field_list[$field_name]))) {
        $errors[$field_name] = "Field $field_name is required.";
        return false;
    }
    
    $value = trim($field_list[$field_name]);
    $pattern = "/^[a-zA-Z' -]+$/";
    
    if (!preg_match($pattern, $value)) {
        $errors[$field_name] = "Field $field_name must contain only letters, spaces, apostrophes, and hyphens.";
        return false;
    }
    
    return true;
}

/**
 * Validasi email
 */
function validateEmail($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || empty(trim($field_list[$field_name]))) {
        $errors[$field_name] = "Field $field_name is required.";
        return false;
    }
    
    $email = trim($field_list[$field_name]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[$field_name] = "Field $field_name must be a valid email address.";
        return false;
    }
    
    return true;
}

/**
 * Validasi nomor telepon
 */
function validatePhone($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || empty(trim($field_list[$field_name]))) {
        $errors[$field_name] = "Field $field_name is required.";
        return false;
    }
    
    $phone = trim($field_list[$field_name]);
    $pattern = "/^[0-9+() -]+$/";
    
    if (!preg_match($pattern, $phone)) {
        $errors[$field_name] = "Field $field_name must contain only numbers, spaces, and valid phone characters (+, -, (), ).";
        return false;
    }
    
    return true;
}

/**
 * Validasi usia (numeric)
 */
function validateAge($field_list, $field_name, &$errors) {
    if (!isset($field_list[$field_name]) || empty(trim($field_list[$field_name]))) {
        $errors[$field_name] = "Field $field_name is required.";
        return false;
    }
    
    $age = trim($field_list[$field_name]);
    if (!is_numeric($age)) {
        $errors[$field_name] = "Field $field_name must be a number.";
        return false;
    }
    
    $age = intval($age);
    if ($age < 1 || $age > 120) {
        $errors[$field_name] = "Field $field_name must be between 1 and 120.";
        return false;
    }
    
    return true;
}
?>