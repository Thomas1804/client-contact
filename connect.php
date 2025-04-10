<?php
// Define your DB credentials
$servername = "localhost";       // or your DB server address
$username   = "root";            // default XAMPP user
$password   = "";                // default password is empty in XAMPP
$dbname     = "client_contact_management"; // your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
