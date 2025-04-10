<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Client</title>
    <link rel="stylesheet" href="public/css/style.css"> <!-- Optional external CSS -->
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
            display: block;
            margin-top: 1.5rem;
            color: #4a2e1f;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add New Client</h2>
        <form method="POST" class="form-card">
            <input type="text" name="client_name" placeholder="Client Name" required>
            <input type="text" name="client_code" placeholder="Client Code (optional)">
            <button type="submit" name="add">Add Client</button>
        </form>

        <?php
        if (isset($_POST['add'])) {
            $name = trim($_POST['client_name']);
            $code = trim($_POST['client_code']);

            // Auto-generate client code if not provided
            if (empty($code)) {
                $code = "CLI" . str_pad(rand(1, 999), 3, "0", STR_PAD_LEFT);
            } else {
                $code = strtoupper($code);
            }

            $stmt = $conn->prepare("INSERT INTO client (client_name, client_code) VALUES (?, ?)");
            $stmt->bind_param("ss", $name, $code);

            if ($stmt->execute()) {
                echo "<div class='result'>✅ Client added successfully.<br><strong>Code: $code</strong></div>";
            } else {
                echo "<div class='result'>❌ Error: " . $stmt->error . "</div>";
            }
        }
        ?>
        <a href="index.php" class="back-link">← Back to Home</a>
    </div>
</body>
</html>
