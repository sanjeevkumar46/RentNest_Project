<?php
// ================================
// Database Connection
// File: config/db.php
// ================================

// Database Server
$host = "localhost";

// Database Username
$username = "root";

// Database Password
$password = "";

// Database Name
$database = "rentnest";

// MySQL Port
$port = 3307;

// Create Connection
$conn = mysqli_connect($host, $username, $password, $database, $port);

// Check Connection
if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

// Connection Successful
// echo "Database Connected Successfully!";
?>