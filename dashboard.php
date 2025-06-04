<?php
include 'config.php'; // Include database configuration

// Fetch total users count
$sql_total_users = "SELECT COUNT(*) AS total_users FROM users";
$result = $conn->query($sql_total_users);
$total_users = ($result->num_rows > 0) ? $result->fetch_assoc()['total_users'] : 0;

// Fetch today's users count
$today = date('Y-m-d');
$sql_users_today = "SELECT COUNT(*) AS users_today FROM users WHERE DATE(created_at) = '$today'";
$result = $conn->query($sql_users_today);
$users_today = ($result->num_rows > 0) ? $result->fetch_assoc()['users_today'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .dashboard {
            display: flex;
            justify-content: space-around;
            margin: 30px 0;
        }
        .card {
            background: #e9ecef;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .card h3 { color: #333; }
        .card p { font-size: 2em; font-weight: bold; color: #007bff; }
        .back-link {
            position: absolute;
            left: 10px;
            top: 10px;
            background: #007bff;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Dashboard</h2>

        <div class="dashboard">
            <div class="card">
                <h3>Total Users</h3>
                <p><?php echo $total_users; ?></p>
            </div>
            <div class="card">
                <h3>Users Today</h3>
                <p><?php echo $users_today; ?></p>
            </div>
        </div>

        <p style="text-align: right; margin-left: 0px; position: absolute; right: 0; top: 0;">
    <a href="index.php" class="btn-cancel" style="background: #007bff;">Back to User</a>
</p>
    </div>
</body>
</html>