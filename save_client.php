<?php
include 'connect.php'; // Make sure this path is correct

// Auto-generate a 6-character client code
$prefix = "CLI";
$random = str_pad(rand(1, 999), 3, "0", STR_PAD_LEFT);
$client_code = $prefix . $random;

// Get submitted form data safely
$client_name = $_POST['client_name'] ?? '';
$contact_code = $_POST['contact_code'] ?? '';

// Use prepared statements for security
$stmt = $conn->prepare("INSERT INTO Client (client_code, client_name, contact_code) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $client_code, $client_name, $contact_code);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Client Saved</title>
    <link rel="stylesheet" href="public/css/style.css"> <!-- Link to your nude brown theme -->
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
            margin-bottom: 1rem;
        }

        .error {
            color: red;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        a {
            text-decoration: none;
            display: inline-block;
            background-color: #e4c9b5;
            color: #4a2e1f;
            padding: 0.6rem 1rem;
            border-radius: 8px;
            margin: 0.5rem 0.3rem;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #d4b4a1;
        }
    </style>
</head>
<body>
<div class="container">
    <?php if ($stmt->execute()): ?>
        <h2 class="success">✅ Client added successfully!</h2>
        <p><strong>Generated Client Code:</strong> <?= htmlspecialchars($client_code) ?></p>
    <?php else: ?>
        <div class="error">
            ❌ Error: <?= $stmt->error ?>
        </div>
    <?php endif; ?>

    <div class="actions">
        <a href="client_form.php">← Add Another Client</a>
        <a href="clients.php">📂 View All Clients</a>
        <a href="index.php">🏠 Back to Home</a>
    </div>
</div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
