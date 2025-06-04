<?php
// dashboard.php (PHP part remains the same)

include 'config.php'; // Your database connection details

// 1. Get Total Users Count
$sql_total_users = "SELECT COUNT(id) AS total_count FROM users";
$result_total_users = $conn->query($sql_total_users);

$total_users = 0;
if ($result_total_users && $result_total_users->num_rows > 0) {
    $row_total = $result_total_users->fetch_assoc();
    $total_users = $row_total['total_count'];
}

// 2. Set Active Users Count equal to Total Users Count
$active_users_count = $total_users; // THIS IS THE CHANGE

// The original "Get Active Users Count" query is now effectively ignored
// if you want active users to always be equal to total users.
// If you uncomment the below, it will override the above line.
/*
$sql_active_users = "SELECT COUNT(id) AS active_count FROM users WHERE status = 'active'";
$result_active_users_query = $conn->query($sql_active_users);
if ($result_active_users_query && $result_active_users_query->num_rows > 0) {
    $row_active = $result_active_users_query->fetch_assoc();
    $active_users_count = $row_active['active_count'];
}
*/

if ($conn) {
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Minimalist Light Theme</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; /* Modern system fonts */
            background-color: #f8f9fa; /* Very light grey background */
            color: #212529; /* Dark text for readability */
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            width: 100%;
            max-width: 900px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.07); /* Softer, slightly larger shadow */
            border: 1px solid #dee2e6; /* Light border for container */
            margin-top: 20px;
        }
        h2 {
            text-align: center;
            color: #343a40;
            margin-bottom: 30px;
            font-weight: 600;
            font-size: 1.9em;
        }
        .dashboard-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); /* Responsive grid */
            gap: 25px; /* Space between cards */
            margin-bottom: 30px;
        }
        .dashboard-card {
            background-color: #ffffff;
            border: 1px solid #e9ecef; /* Very light card border */
            border-radius: 6px;
            padding: 25px; /* Increased padding */
            text-align: left;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05); /* Very subtle card shadow */
            transition: box-shadow 0.3s ease, border-color 0.3s ease, transform 0.3s ease;
        }
        .dashboard-card:hover {
            border-color: #007bff; /* Blue border on hover */
            box-shadow: 0 5px 12px rgba(0,123,255,0.1); /* Blueish shadow on hover */
            transform: translateY(-4px);
        }
        .dashboard-card h3 {
            margin-top: 0;
            font-size: 1.2em; /* Slightly larger card title */
            color: #495057;
            margin-bottom: 10px;
            font-weight: 500;
        }
        .dashboard-card .count {
            font-size: 3em;
            font-weight: 700; /* Bold count */
            color: #007bff; /* Standard blue accent */
            margin-bottom: 10px;
            display: block;
        }
        .dashboard-card .note {
            font-size: 0.9em;
            color: #6c757d;
            line-height: 1.5; /* Improved line spacing */
        }
        .dashboard-card .note small em {
            color: #868e96;
        }
        .nav-link-container {
            text-align: center; /* Centers the inline-block link */
        }
        .nav-link {
            display: inline-block;
            text-align: center;
            margin-top: 20px;
            padding: 12px 28px; /* Slightly more padding */
            background-color: #28a745; /* Green for action button */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.2s ease, transform 0.2s ease;
            font-weight: 500;
            border: none;
        }
        .nav-link:hover {
            background-color: #218838; /* Darker green */
            transform: translateY(-2px) scale(1.03); /* Lift and slight zoom */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Statistics Dashboard ☀️</h2>

        <div class="dashboard-container">
            <div class="dashboard-card">
                <h3>Total Users 👥</h3>
                <p class="count"><?php echo $total_users; ?></p>
                <p class="note">Overall number of registered users.</p>
            </div>
            <div class="dashboard-card">
                <h3>Active Users </h3>
                <p class="count"><?php echo $active_users_count; ?></p>
            </div>
        </div>
        <div class="nav-link-container">
            <a href="index.php" class="nav-link">⚙️ Go to User Management</a>
        </div>
    </div>
</body>
</html>