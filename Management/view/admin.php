<?php
session_start();
include '../Model/db.php';

$db = new mydb();
$conn = $db->openCon();

// Handle delete request (delete photo file step is skipped)
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);

    // Delete record from admin table
    $sql = "DELETE FROM admin WHERE id = $delete_id";
    $conn->query($sql);

    // Redirect to avoid deleting again on refresh
    header("Location: admin.php");
    exit();
}

// Fetch all admin records
$result = $db->showAllUsers("admin", $conn);
?>

<html>
<head>
    <title>Admin List</title>
    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this admin?")) {
                window.location.href = "admin.php?delete_id=" + id;
            }
        }
    </script>
</head>
<body>

<h2>All Admins</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th><th>Photo</th><th>Name</th><th>Email</th><th>Phone</th><th>Password</th><th>Location</th><th>DOB</th><th>Actions</th>
    </tr>

    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><img src="<?php echo $row["photo"]; ?>" width="50"></td>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["phone"]; ?></td>
                <td><?php echo $row["password"]; ?></td>
                <td><?php echo $row["location"]; ?></td>
                <td><?php echo $row["dob"]; ?></td>
                <td>
                    <a href="edit_admin.php?id=<?php echo $row["id"]; ?>">Edit</a> |
                    <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $row["id"]; ?>)">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="9">No admin found.</td></tr>
    <?php endif; ?>
</table>

<br>
<a href="admin_Regestration.php"><button>Add New Admin</button></a><br>
<a href="management.php">← Back to Management Page</a>

</body>
</html>
