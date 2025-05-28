<?php
include(__DIR__ . "/../model/db.php");

$msg = '';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $nid = $_POST['nid'];
    $nationality = $_POST['nationality'];
    $gender = $_POST['gender'];

    $select_query = "SELECT * FROM `users` WHERE email = '$email'";
    $result = mysqli_query($conn, $select_query);

    if (mysqli_num_rows($result) > 0) {
        $msg = "User already exists!";
    } else {
        $insert_query = "INSERT INTO `users`(`name`, `email`, `password`, `nid`, `nationality`, `gender`) 
                         VALUES ('$name', '$email', '$password', '$nid', '$nationality', '$gender')";

        if (mysqli_query($conn, $insert_query)) {
            header("Location: login.php");
            exit();
        } else {
            $msg = "Database error: " . mysqli_error($conn);
        }
    }
}
?>
