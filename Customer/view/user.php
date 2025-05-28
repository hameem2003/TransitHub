<?php include(__DIR__ . "/../control/usercontrol.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>User Dashboard</title>
</head>
<body>

<h2>Welcome to Transithub</h2>

<?php if (!isset($_GET['edit'])): ?>

    <p>Name: <?= $user_data['name'] ?></p>
    <p>Email: <?= $user_data['email'] ?></p>
    <p>National ID: <?= $user_data['nid'] ?></p>
    <p>Nationality: <?= $user_data['nationality'] ?></p>
    <p>Gender: <?= $user_data['gender'] ?></p>

    <a href="?edit=1"><button>Update your info?</button></a>
    <br><br>
    <a href="logout.php"><button>Logout</button></a>

<?php else: ?>

    <form method="post">
        <label>Name:</label><br>
        <input type="text" name="name" value="<?= $user_data['name'] ?>" required><br><br>

        <label>Nationality:</label><br>
        <input type="text" name="nationality" value="<?= $user_data['nationality'] ?>" required><br><br>

        <label>Gender:</label><br>
        <input type="text" name="gender" value="<?= $user_data['gender'] ?>" required><br><br>

        <button type="submit" name="update">Update Info</button>
        <button type="submit" name="delete" onclick="return confirm('Are you sure to delete your account?');">Delete Account</button>
    </form>

    <br>
    <a href="user.php"><button>Cancel</button></a>

<?php endif; ?>

</body>
</html>
