<?php
// Database connection settings
$servername = "localhost"; // Change this if you're using a different host (e.g., "127.0.0.1")
$username = "root";        // MySQL username (default is 'root')
$password = "";            // MySQL password (leave empty if none)
$dbname = "loginchiper";   // Name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
