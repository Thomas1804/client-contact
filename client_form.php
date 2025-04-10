<?php
include 'connect.php';

// Function to generate client code
function generateClientCode($client_name, $conn) {
    $letters = strtoupper(preg_replace('/[^A-Z]/', '', substr($client_name, 0, 3)));

    // Pad if less than 3 characters
    while (strlen($letters) < 3) {
        $letters .= chr(65 + strlen($letters)); // A-Z
    }

    // Try numeric part from 001 to 999
    for ($i = 1; $i < 1000; $i++) {
        $num = str_pad($i, 3, "0", STR_PAD_LEFT);
        $code = $letters . $num;

        $stmt = $conn->prepare("SELECT client_id FROM Client WHERE client_code = ?");
        $stmt->bind_param("s", $code);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            $stmt->close();
            return $code; // Unique
        }
        $stmt->close();
    }

    return null; // Could not generate
}

$success = false;
$generated_code = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_name = trim($_POST['client_name']);
    $contact_code = trim($_POST['contact_code']);

    $generated_code = generateClientCode($client_name, $conn);

    if (!preg_match('/^[A-Z]{3}[0-9]{3}$/', $generated_code)) {
        $error = "Invalid client code format.";
    } else {
        $stmt = $conn->prepare("INSERT INTO Client (client_code, client_name, contact_code) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $generated_code, $client_name, $contact_code);

        if ($stmt->execute()) {
            $success = true;
        } else {
            $error = "❌ Error: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Client</title>
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
        h2 {
            margin-bottom: 1rem;
            color: #4a2e1f;
        }
        .form-card {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 1rem;
        }
        input[type="text"] {
            padding: 0.6rem;
            border: 1px solid #d6bfae;
            border-radius: 8px;
        }
        button {
            background-color: #b78c6f;
            color: white;
            border: none;
            padding: 0.6rem 1rem;
            border-radius: 8px;
            cursor: pointer;
        }
        button:hover {
            background-color: #a7785f;
        }
        .result {
            margin-top: 1rem;
            color: #4a2e1f;
        }
        .back-link {
            display: inline-block;
            margin-top: 1.5rem;
            color: #4a2e1f;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($success): ?>
            <h2>✅ Client Added!</h2>
            <p class="result">Generated Client Code: <strong><?= htmlspecialchars($generated_code) ?></strong></p>
            <a href="client_form.php" class="back-link">➕ Add Another Client</a><br>
            <a href="index.php" class="back-link">🏠 Back to Home</a>
        <?php else: ?>
            <h2>Add New Client</h2>
            <?php if ($error): ?>
                <p class="result" style="color: red;"><?= $error ?></p>
            <?php endif; ?>
            <form method="POST" class="form-card">
                <input type="text" name="client_name" placeholder="Client Name" required>
                <input type="text" name="contact_code" placeholder="Contact Code (Optional)">
                <button type="submit">Add Client</button>
            </form>
            <a href="index.php" class="back-link">🏠 Back to Home</a>
        <?php endif; ?>
    </div>
</body>
</html>
<?php $conn->close(); ?>
