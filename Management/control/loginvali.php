<?php
session_start();

$emailError = $passError = "";
$loginSuccess = "";
$email = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";

    // Manual validation
    if (empty($email)) {
        $emailError = "Email is required.";
    }

    if (empty($password)) {
        $passError = "Password is required.";
    }

    if ($emailError == "" && $passError == "") {
        include '../Model/db.php';
        $db = new mydb();
        $conn = $db->openCon();

        $email = $conn->real_escape_string($email);
        $password = $conn->real_escape_string($password);

        // Check admin
        $sql = "SELECT * FROM admin WHERE email='$email' AND password='$password' LIMIT 1";
        $result = $conn->query($sql);

        if ($result && $result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $_SESSION["admin_id"] = $row["id"];    
            $_SESSION["uname"] = $row["name"];
            $_SESSION["role"] = "admin";
            header("Location: management.php");
            exit();
        }

       /* // Check customer
        $sql2 = "SELECT * FROM customer WHERE email='$email' AND password='$password' LIMIT 1";
        $result2 = $conn->query($sql2);

        if ($result2 && $result2->num_rows === 1) {
            $row = $result2->fetch_assoc();
            $_SESSION["uname"] = $row["name"];
            $_SESSION["role"] = "customer";
            header("Location: ../Customer/customer.php");
            exit();
        }*/

        $passError = "Invalid email or password.";
    }
}
?>
