<?php
session_start();
include '../Model/db.php';

$db = new mydb();
$conn = $db->openCon();

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $db->deleteUserByID("users", $conn, $delete_id);
    header("Location: show_all_customer.php");
    exit();
}

// Fetch all users
$result = $db->showAllUsers("users", $conn);
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Customer List</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { padding: 8px; border: 1px solid #ccc; }
    </style>
    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this customer?")) {
                window.location.href = "show_all_customer.php?delete_id=" + id;
            }
        }
    </script>
</head>
<body>
    <h2>All Customers</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>NID</th>
            <th>Nationality</th>
            <th>Gender</th>
            <th>Actions</th>
        </tr>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['password']) ?></td>
                    <td><?= htmlspecialchars($row['nid']) ?></td>
                    <td><?= htmlspecialchars($row['nationality']) ?></td>
                    <td><?= htmlspecialchars($row['gender']) ?></td>
                    <td>
                       
                        <a href="javascript:void(0)" onclick="confirmDelete(<?= $row['id'] ?>)">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="8">No customers found.</td></tr>
        <?php endif; ?>
    </table>

    <p>
        
        <a href="management.php">← Back to Management Panel</a>
    </p>
</body>
</html>
