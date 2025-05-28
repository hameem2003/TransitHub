<?php include(__DIR__ . "/../control/registercontrol.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Registration</title>
</head>
<body>
    <h2>Customer Registration</h2>
    
    <form action="" method="post">
        <p style="color:red;"><?= $msg ?></p>

        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <label>National ID:</label><br>
        <input type="text" name="nid" required><br><br>

        <label>Nationality:</label><br>
        <input type="text" name="nationality" required><br><br>

        <label>Gender:</label><br>
        <input type="text" name="gender" required><br><br>

        <button type="submit" name="submit">Register Now</button>
    </form>

    <p>Already have an account? <a href="login.php">Login Now</a></p>
</body>
</html>

