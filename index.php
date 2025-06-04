<?php
include 'config.php';

// Delete record
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM users WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    }
}

// Fetch all records
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple CRUD Application</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>User Management System</h2>
        <a href="create.php" class="btn-add">Add New User</a>
        <a href="dashboard.php" class="btn-add">Dashboard</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>   
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row['id']."</td>";
                        echo "<td>".$row['name']."</td>";
                        echo "<td>".$row['email']."</td>";
                        echo "<td>
                                <a href='edit.php?id=".$row['id']."' class='btn-edit'>Edit</a>
                                <a href='index.php?delete=".$row['id']."' class='btn-delete' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html> 