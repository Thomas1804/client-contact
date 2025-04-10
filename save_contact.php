<?php
include 'connect.php'; // Make sure this file sets up $conn properly

// Initialize flags
$success = false;
$error = '';
$notfound = false;

// Handle POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name         = trim($_POST['contact_name'] ?? '');
    $surname      = trim($_POST['contact_surname'] ?? '');
    $contact_code = trim($_POST['contact_code'] ?? '');
    $client_code  = trim($_POST['client_code'] ?? '');
    $email        = trim($_POST['email'] ?? '');

    // Check if client exists
    $check = $conn->prepare("SELECT client_code FROM client WHERE client_code = ?");
    $check->bind_param("s", $client_code);
    $check->execute();
    $result = $check->get_result();

    if ($result && $result->num_rows > 0) {
        // Insert contact
        $stmt = $conn->prepare("INSERT INTO contact (contact_name, contact_surname, contact_code, email, client_code) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $surname, $contact_code, $email, $client_code);

        if ($stmt->execute()) {
            $success = true;
        } else {
            $error = $stmt->error;
        }
        $stmt->close();
    } else {
        $notfound = true;
    }
    $check->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Status</title>
    <link rel="stylesheet" href="public/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f1ec;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff7f0;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }
        .success {
            color: #4a2e1f;
            font-weight: bold;
        }
        .error {
            color: #a94442;
            font-weight: bold;
        }
        a {
            display: inline-block;
            margin-top: 1rem;
            text-decoration: none;
            background-color: #e4c9b5;
            color: #4a2e1f;
            padding: 0.6rem 1rem;
            border-radius: 8px;
            transition: background 0.3s;
        }
        a:hover {
            background-color: #d4b4a1;
        }
    </style>
</head>
<body>
<div class="container">
    <?php if ($success): ?>
        <h2 class="success">✅ Contact added successfully!</h2>
        <p><strong>Contact Code:</strong> <?= htmlspecialchars($contact_code) ?></p>
    <?php elseif ($notfound): ?>
        <h2 class="error">❌ Error: Client code "<strong><?= htmlspecialchars($client_code) ?></strong>" does not exist.</h2>
    <?php else: ?>
        <h2 class="error">❌ Error: <?= htmlspecialchars($error) ?></h2>
    <?php endif; ?>

    <a href="contact_form.php">← Add Another Contact</a>
    <a href="contacts.php" style="margin-left: 10px;">📇 View All Contacts</a>
</div>
</body>
</html>
