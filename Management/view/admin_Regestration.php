<?php
session_start();

$name = $email = $phone = $location = $password = $dob = "";
$photoPath = "";
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Manual validation
    if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["phone"]) || empty($_POST["location"]) || empty($_POST["password"]) || empty($_POST["dob"])) {
        $error = "All fields are required.";
    } elseif (!isset($_FILES["photo"]) || $_FILES["photo"]["error"] != 0) {
        $error = "Photo is required and must be valid.";
    } else {
        // Assign values
        $name     = $_POST["name"];
        $email    = $_POST["email"];
        $phone    = $_POST["phone"];
        $location = $_POST["location"];
        $password = $_POST["password"];
        $dob      = $_POST["dob"];

        include '../Model/db.php';
    $db = new mydb();
    $conn = $db->openCon();

    // ✅ Check if email already exists
    if ($db->checkEmailExists("admin", $email, $conn)) {
        $error = "Email already registered!";
    } 
    else 
    {
        // Check if file is uploaded
if (!empty($_FILES["photo"]["name"])) {
    $photoName = basename($_FILES["photo"]["name"]);
    $targetDir = "../uploads/";

    // Make sure uploads folder exists
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $photoPath = $targetDir . $photoName;

    // Move the uploaded file first
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $photoPath)) {
        // Now insert into DB
        $result = $db->addAdmin(
            "admin",
            $name,
            $email,
            $phone,
            $location,
            $password,
            $dob,
            $photoPath,
            $conn
        );

        if ($result === true) {
            $success = "Admin registered successfully!";
        } else {
            $error = "Database error: " . $conn->error;
        }
    } else {
        $error = "Failed to upload photo.";
    }
} else {
    $error = "No photo selected to upload.";
}

}   }}
?>

<html>
<head>
    <title>Admin Registration</title>
</head>
<body>

<h2>Register New Admin</h2>

<?php if ($error != "") { echo "<p style='color:red;'>$error</p>"; } ?>
<?php if ($success != "") { echo "<p style='color:green;'>$success</p>"; } ?>

<form method="POST" enctype="multipart/form-data">
    Name: <input type="text" name="name" value="<?php echo $name; ?>"><br><br>
    Email: <input type="email" name="email" value="<?php echo $email; ?>"><br><br>
    Phone: <input type="text" name="phone" value="<?php echo $phone; ?>"><br><br>
    Location: <input type="text" name="location" value="<?php echo $location; ?>"><br><br>
    Password: <input type="password" name="password"><br><br>
    Date of Birth: <input type="date" name="dob" value="<?php echo $dob; ?>"><br><br>
    Photo: <input type="file" name="photo"><br><br>

    <input type="submit" value="Register">
</form>

<br>



</body>
<a href="/TransitHub/Management/view/admin.php">← Back to Admin List</a>
</html>
