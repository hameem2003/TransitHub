<?php
session_start();
include '../Model/db.php';

if (!isset($_SESSION['admin_id'])) {
    echo "Access denied. Please <a href='login.php'>log in</a>.";
    exit();
}


$id = $_SESSION['admin_id'];

$db   = new mydb();
$conn = $db->openCon();

$rs = $db->searchUserByID("admin", $conn, $id);
if (!$rs || $rs->num_rows === 0) {
    die("User not found.");
    
}
$user = $rs->fetch_assoc();

$name     = $user['name'];
$email    = $user['email'];
$phone    = $user['phone'];
$location = $user['location'];
$dob      = $user['dob'];
$photo    = $user['photo'];
$error    = "";
$success  = "";

// Update form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $location = $_POST['location'];
    $dob      = $_POST['dob'];
    $password = $_POST['password']; // optional

    // Basic validation
    if (!$name || !$email || !$phone || !$location || !$dob) {
        $error = "All fields except password and photo are required.";
    } else {
        // Handle photo upload
        $newPhoto = $photo;
        if (!empty($_FILES["photo"]["name"]) && $_FILES["photo"]["error"] == 0) {
            $photoName = basename($_FILES["photo"]["name"]);
            $targetDir = "../uploads/";
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            $newPhoto = $targetDir . $photoName;
            if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $newPhoto)) {
                $error = "Failed to upload photo.";
            }
        }

        if (!$error) {
            $sets = [];
            $sets[] = "name = '$name'";
            $sets[] = "email = '$email'";
            $sets[] = "phone = '$phone'";
            $sets[] = "location = '$location'";
            $sets[] = "dob = '$dob'";
            $sets[] = "photo = '$newPhoto'";
            if (!empty($password)) {
                $hashed = password_hash($password, PASSWORD_DEFAULT);
                $sets[] = "password = '$hashed'";
            }

            $setString = implode(", ", $sets);

            $sql = "UPDATE admin SET $setString WHERE id = $id";

            if ($conn->query($sql)) {
                $success = "Profile updated successfully!";
                $photo = $newPhoto; // refresh photo path
            } else {
                $error = "Database error: " . $conn->error;
            }
        }
    }
}
?>
<html>
<head>
    <title>Your Profile</title>
</head>
<body>
    <h2>My Profile</h2>

    <?php if ($error): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php elseif ($success): ?>
        <p style="color:green;"><?php echo $success; ?></p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        Name:<br>
        <input type="text" name="name" value="<?php echo $name; ?>"><br><br>

        Email:<br>
        <input type="email" name="email" value="<?php echo $email; ?>"><br><br>

        Phone:<br>
        <input type="text" name="phone" value="<?php echo $phone; ?>"><br><br>

        Location:<br>
        <input type="text" name="location" value="<?php echo $location; ?>"><br><br>

        Date of Birth:<br>
        <input type="date" name="dob" value="<?php echo $dob; ?>"><br><br>

        Password (leave blank to keep same):<br>
        <input type="password" name="password"><br><br>

        Photo:<br>
        <?php if ($photo): ?>
            <img src="<?php echo $photo; ?>" width="80"><br>
        <?php endif; ?>
        <input type="file" name="photo"><br><br>

        <input type="submit" value="Update Profile">
    </form>

    <br>
    <a href="management.php">← Back to Management</a>
</body>
</html>
