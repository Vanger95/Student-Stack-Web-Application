<?php
session_start();
include 'includes/db.php';
include 'includes/auth.php';

require_admin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Area</title>
</head>
<body>
    <h1>Welcome, Admin</h1>
    <a href="logout.php">Logout</a>
</body>
</html>
