<?php
$emailError = $passError = "";
$loginSuccess = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";

    // Email validation
    if (empty($email)) {
        $emailError = "Email is required.";
    } 

    // Password validation
    if (empty($password)) {
        $passError = "Password is required.";
    } 

    // Check if all is OK
    if ($emailError == "" && $passError == "") {
        // You can add DB login check here (optional)
        $loginSuccess = "Login successful.";
    }
}
?>
