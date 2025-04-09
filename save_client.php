<?php
include 'connect.php';

// Auto-generate a 6-char client code (e.g., CLI123)
$prefix = "CLI";
$random = str_pad(rand(1, 999), 3, "0", STR_PAD_LEFT);
$client_code = $prefix . $random;

$client_name = $_POST['client_name'];
$contact_code = $_POST['contact_code'];

$sql = "INSERT INTO Client (client_code, client_name, contact_code)
        VALUES ('$client_code', '$client_name', '$contact_code')";

if ($conn->query($sql) === TRUE) {
    echo "<h2>✅ Client added successfully!</h2>";
    echo "<p>Client Code: $client_code</p>";
    echo "<a href='client-form.php'>Add Another</a>";
} else {
    echo "<p>❌ Error: " . $conn->error . "</p>";
}

$conn->close();
?>
