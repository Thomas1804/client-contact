<?php
include 'connect.php';

$name = $_POST['contact_name'];
$surname = $_POST['contact_surname'];
$contact_code = $_POST['contact_code'];
$client_code = $_POST['client_code'];
$email = $_POST['email'];

$sql = "INSERT INTO Contact (contact_name, contact_surname, contact_code, client_code, email)
        VALUES ('$name', '$surname', '$contact_code', '$client_code', '$email')";

if ($conn->query($sql) === TRUE) {
    echo "<h2>✅ Contact added successfully!</h2>";
    echo "<a href='contact_form.php'>Add Another Contact</a><br>";
    echo "<a href='index.php'>Back to Home</a>";
} else {
    echo "❌ Error: " . $conn->error;
}

$conn->close();
?>
