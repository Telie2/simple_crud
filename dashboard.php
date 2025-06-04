<?php
// dashboard.php

include 'config.php'; // Your database connection details

// 1. Get Total Users Count
$sql_total_users = "SELECT COUNT(id) AS total_count FROM users";
$result_total_users = $conn->query($sql_total_users);

$total_users = 0;
if ($result_total_users && $result_total_users->num_rows > 0) {
    $row_total = $result_total_users->fetch_assoc();
    $total_users = $row_total['total_count'];
} else {
    // Handle error or set to 0 if query fails
    // For simplicity, we'll keep it 0 or you can echo $conn->error;
}

// 2. Get Active Users Count
// ASSUMPTION: Your 'users' table has a 'status' column, and 'active' means the user is active.
// OR, you might have an 'is_active' column (e.g., TINYINT) where 1 means active.
// Please adjust the column name ('status') and value ('active') below if your setup is different.
$sql_active_users = "SELECT COUNT(id) AS active_count FROM users WHERE status = 'active'";
// Example if using an 'is_active' TINYINT column:
// $sql_active_users = "SELECT COUNT(id) AS active_count FROM users WHERE is_active = 1";

$result_active_users_query = $conn->query($sql_active_users);

$active_users_count = 0;
if ($result_active_users_query && $result_active_users_query->num_rows > 0) {
    $row_active = $result_active_users_query->fetch_assoc();
    $active_users_count = $row_active['active_count'];
} else {
    // Handle error or set to 0 if query fails or column doesn't exist
    // For simplicity, we'll keep it 0 or you can echo $conn->error;
}

// Close the database connection as we have fetched all required data
if ($conn) {
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* You can place these styles in style.css or keep them here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column; /* Align items vertically */
            align-items: center; /* Center content horizontally */
        }
        .container {
            width: 100%;
            max-width: 900px; /* Max width for the content */
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .dashboard-container {
            display: flex;
            flex-wrap: wrap; /* Allow cards to wrap on smaller screens */
            gap: 25px; /* Space between cards */
            justify-content: center; /* Center cards if they don't fill the row */
            margin-bottom: 30px;
        }
        .dashboard-card {
            background-color: #ffffff; /* Card background */
            border: 1px solid #e0e0e0; /* Light border for the card */
            border-left: 5px solid #007bff; /* Accent color on the left */
            border-radius: 8px;
            padding: 25px;
            text-align: left; /* Align text to the left within card */
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            flex: 1; /* Allows cards to grow */
            min-width: 250px; /* Minimum width for cards */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.12);
        }
        .dashboard-card h3 {
            margin-top: 0;
            font-size: 1.3em;
            color: #333333;
            margin-bottom: 10px;
        }
        .dashboard-card .count {
            font-size: 3em; /* Larger number for the count */
            font-weight: bold;
            color: #007bff; /* Primary color for the count */
            margin-bottom: 10px;
            display: block; /* Make it a block to take full width */
        }
        .dashboard-card .note {
            font-size: 0.9em;
            color: #6c757d; /* Muted color for the note */
        }
        .nav-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .nav-link:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Statistics Dashboard 📊</h2>

        <div class="dashboard-container">
            <div class="dashboard-card">
                <h3>Total Users 👥</h3>
                <p class="count"><?php echo $total_users; ?></p>
                <p class="note">Overall number of registered users.</p>
            </div>
            <div class="dashboard-card">
                <h3>Active Users 🟢</h3>
                <p class="count"><?php echo $active_users_count; ?></p>
                <p class="note">Users currently marked as 'active'.<br>
                <small><em>(This count assumes a 'status' column with 'active' value, or similar logic for 'is_active'.)</em></small>
                </p>
            </div>
        </div>

        <a href="index.php" class="nav-link">⚙️ Go to User Management</a>
    </div>
</body>
</html>