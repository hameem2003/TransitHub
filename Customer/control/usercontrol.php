<?php
session_start();
include(__DIR__ . "/../model/db.php");

if (!isset($_SESSION['user'])) {
    header("Location: ../view/login.php");
    exit();
}

$user_email = $_SESSION['user'];

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $nationality = $_POST['nationality'];
    $gender = $_POST['gender'];
    $query = "UPDATE users SET name='$name', nationality='$nationality', gender='$gender' WHERE email='$user_email'";
    mysqli_query($conn, $query);
    header("Location: ../view/user.php");
    exit();
}

if (isset($_POST['delete'])) {
    $query = "DELETE FROM users WHERE email='$user_email'";
    mysqli_query($conn, $query);
    session_destroy();
    header("Location: ../view/register.php");
    exit();
}

$query = "SELECT * FROM users WHERE email='$user_email'";
$result = mysqli_query($conn, $query);
$user_data = mysqli_fetch_assoc($result);
?>
