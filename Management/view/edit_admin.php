<?php
session_start();
include '../Model/db.php';

$db   = new mydb();
$conn = $db->openCon();

// 1) Get the admin ID from the URL
if (!isset($_GET['id'])) {
    die("No admin ID provided");
}
$id = intval($_GET['id']);

// 2) Fetch existing record
$rs = $db->searchUserByID("admin", $conn, $id);
if (!$rs || $rs->num_rows === 0) {
    die("Admin not found");
}
$admin = $rs->fetch_assoc();

// initialize variables for form
$name     = $admin['name'];
$email    = $admin['email'];
$phone    = $admin['phone'];
$location = $admin['location'];
$dob      = $admin['dob'];
$oldPhoto = $admin['photo'];   // store the old path
$error    = "";
$success  = "";

// 3) Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // grab POSTed values
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $location = $_POST['location'];
    $dob      = $_POST['dob'];
    $password = $_POST['password'];  // if left blank, we won't update it

    // manual validation
    if (!$name || !$email || !$phone || !$location || !$dob) {
        $error = "All fields except password and photo are required.";
    } else {
        // Check for duplicate email in other records
        $check = $conn->query(
            "SELECT id 
             FROM admin 
             WHERE email = '$email' AND id <> $id
             LIMIT 1"
        );
        if ($check && $check->num_rows > 0) {
            $error = "That email is already in use by another admin.";
        } else {
            // Handle photo upload (optional)
            $photoPath = $oldPhoto;
            if (!empty($_FILES['photo']['name']) && $_FILES['photo']['error'] === 0) {
                $photoName = basename($_FILES['photo']['name']);
                $targetDir = "../uploads/";
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }
                $photoPath = $targetDir . $photoName;
                if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
                    $error = "Failed to upload new photo.";
                }
            }

            if (!$error) {
                // Build the UPDATE query
                $sets = [];
                $sets[] = "name     = '$name'";
                $sets[] = "email    = '$email'";
                $sets[] = "phone    = '$phone'";
                $sets[] = "location = '$location'";
                $sets[] = "dob      = '$dob'";
                $sets[] = "photo    = '$photoPath'";
                if ($password) {
                    // only update password if provided
                    $sets[] = "password = '$password'";
                }
                $setString = implode(", ", $sets);

                $sql = "UPDATE admin 
                        SET $setString 
                        WHERE id = $id";

                if ($conn->query($sql)) {
                    // success—redirect back
                    header("Location: admin.php");
                    exit();
                } else {
                    $error = "Database error: " . $conn->error;
                }
            }
        }
    }
}
?>

<html>
<head>
  <title>Edit Admin #<?php echo $id; ?></title>
</head>
<body>
  <h2>Edit Admin</h2>

  <?php if ($error): ?>
    <p style="color:red;"><?php echo $error; ?></p>
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

    Password:<br>
    <input type="password" name="password" placeholder="Leave blank to keep existing"><br><br>

    Photo:<br>
    <?php if ($oldPhoto): ?>
      <img src="<?php echo $oldPhoto; ?>" width="80"><br>
    <?php endif; ?>
    <input type="file" name="photo"><br><br>

    <input type="submit" value="Save Changes">
  </form>

  <p><a href="admin.php">← Back to Admin List</a></p>
</body>
</html>
