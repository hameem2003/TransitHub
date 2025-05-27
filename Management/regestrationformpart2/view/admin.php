<?php
include "../Model/admindb.php";

$myDB = new myDB();
$conn = $myDB->openCon();
$tableName = "admindata";

$nameError = $emailError = $usernameError = $passwordError = $dobError = $phoneError = $locationError = $pictureError = "";
$name = $email = $username = $password = $dob = $phonenumber = $location = "";
$successMsg = $errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    // Simple PHP validation
    $valid = true;

    if (empty($_POST['name'])) {
        $nameError = "Name is required";
        $valid = false;
    } else {
        $name = $_POST['name'];
    }

    if (empty($_POST['email'])) {
        $emailError = "Email is required";
        $valid = false;
    } else {
        $email = $_POST['email'];
    }

    if (empty($_POST['username'])) {
        $usernameError = "Username is required";
        $valid = false;
    } else {
        $username = $_POST['username'];
    }

    if (empty($_POST['password'])) {
        $passwordError = "Password is required";
        $valid = false;
    } else {
        $password = $_POST['password'];
    }

    if (empty($_POST['dob'])) {
        $dobError = "Date of birth is required";
        $valid = false;
    } else {
        $dob = $_POST['dob'];
    }

    if (empty($_POST['phonenumber'])) {
        $phoneError = "Phone number is required";
        $valid = false;
    } else {
        $phonenumber = $_POST['phonenumber'];
    }

    if (empty($_POST['location'])) {
        $locationError = "Location is required";
        $valid = false;
    } else {
        $location = $_POST['location'];
    }

    // Picture upload validation and handling
    if (!isset($_FILES['picture']) || $_FILES['picture']['error'] == UPLOAD_ERR_NO_FILE) {
        $pictureError = "Picture is required";
        $valid = false;
    } else {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $fileName = basename($_FILES["picture"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Check if image
        $check = getimagesize($_FILES["picture"]["tmp_name"]);
        if ($check === false) {
            $pictureError = "File is not an image.";
            $valid = false;
        }

        // Check file size (5MB max)
        if ($_FILES["picture"]["size"] > 5 * 1024 * 1024) {
            $pictureError = "File size is too large.";
            $valid = false;
        }

        // Allow certain file types
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowedTypes)) {
            $pictureError = "Only JPG, JPEG, PNG & GIF files are allowed.";
            $valid = false;
        }
    }

    if ($valid) {
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFilePath)) {
            // Insert data (Note: your insertData function expects many params, so we'll send empty strings for missing fields)
            $result = $myDB->insertData(
                $name, $email, $password, $username, $dob, $phonenumber,
                "", $location, $targetFilePath, "", "", "", "", "", "", $conn
            );

            if ($result === 1) {
                $successMsg = "Record added successfully!";
                // Reset form data
                $name = $email = $username = $password = $dob = $phonenumber = $location = "";
            } else {
                $errorMsg = "Error adding record: $result";
            }
        } else {
            $errorMsg = "Error uploading picture file.";
        }
    }
}

// Delete operation
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $delResult = $myDB->deleteData($id, $tableName, $conn);
    if ($delResult === 1) {
        $successMsg = "Record deleted successfully!";
    } else {
        $errorMsg = "Error deleting record: $delResult";
    }
}

// Fetch all records
$allRecords = $myDB->showAll($tableName, $conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Management</title>
    <style>
        .error {color: red;}
        .success {color: green;}
        table, th, td {border: 1px solid black; border-collapse: collapse; padding: 8px;}
    </style>
</head>
<body>
    <h2>Admin Management</h2>

    <?php
    if ($successMsg != "") {
        echo "<p class='success'>$successMsg</p>";
    }
    if ($errorMsg != "") {
        echo "<p class='error'>$errorMsg</p>";
    }
    ?>

    <h3>Add New Admin</h3>
    <form method="POST" action="" enctype="multipart/form-data">
        Name: <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">
        <span class="error"><?php echo $nameError; ?></span><br><br>

        Email: <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <span class="error"><?php echo $emailError; ?></span><br><br>

        Username: <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">
        <span class="error"><?php echo $usernameError; ?></span><br><br>

        Password: <input type="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
        <span class="error"><?php echo $passwordError; ?></span><br><br>

        Date of Birth: <input type="date" name="dob" value="<?php echo htmlspecialchars($dob); ?>">
        <span class="error"><?php echo $dobError; ?></span><br><br>

        Phone Number: <input type="text" name="phonenumber" value="<?php echo htmlspecialchars($phonenumber); ?>">
        <span class="error"><?php echo $phoneError; ?></span><br><br>

        Location: <input type="text" name="location" value="<?php echo htmlspecialchars($location); ?>">
        <span class="error"><?php echo $locationError; ?></span><br><br>

        Picture: <input type="file" name="picture">
        <span class="error"><?php echo $pictureError; ?></span><br><br>

        <input type="submit" name="add" value="Add Admin">
    </form>

    <h3>All Admin Records</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Username</th><th>DOB</th><th>Phone</th><th>Location</th><th>Picture</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($allRecords && $allRecords->num_rows > 0) {
                while ($row = $allRecords->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . htmlspecialchars($row['Name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['DOB']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['phoneNumber']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['location']) . "</td>";
                    echo "<td>";
                    if ($row['picture'] != "") {
                        echo "<img src='" . htmlspecialchars($row['picture']) . "' width='60' height='60' alt='No Image'>";
                    } else {
                        echo "No Image";
                    }
                    echo "</td>";
                    echo "<td><a href='?delete=" . $row['id'] . "' onclick='return confirm(\"Are you sure to delete?\");'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>

<?php
$myDB->closeCon($conn);
?>
