<?php
include(__DIR__ . "/../model/db.php");
session_start();
$msg = '';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $select1 = "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'";
    $select_user = mysqli_query($conn, $select1);

    if (mysqli_num_rows($select_user) > 0) {
        $user = mysqli_fetch_assoc($select_user);
        $_SESSION['user'] = $user['email'];
        header('Location: user.php');
        exit();
    } else {
        $msg = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Customer Login</h2>
    <form action="" method="post">
        <p class="msg"><?= $msg ?></p>

        <label>Email:</label><br>
        <input type="email" name="email" required><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit" name="submit">Login Now</button>
        <p>Don't have an account? <a href="register.php">Register Now</a></p>
    </form>
</body>
</html>
