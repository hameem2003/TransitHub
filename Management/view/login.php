<?php 
include "../control/loginvali.php"; ?>
<html>
<head><title>Login</title></head>
<body>
    <h2>Login</h2>
    <form method="POST" action="">
        <label>Email:</label><br>
        <input type="text" name="email"><?php echo $emailError; ?><br><br>

        <label>Password:</label><br>
        <input type="password" name="password"><?php echo $passError; ?><br><br>

        <input type="submit" value="Login">

    </form>
<a href="registrationform/customerreg.php">
  <button>As a Customer Registration Now</button>
</a>

</body>
</html>
