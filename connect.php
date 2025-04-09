<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "client_contact_management"; // ✅ Your actual DB name

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}
echo "✅ Connected successfully to MySQL!";
?>
