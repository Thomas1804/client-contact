<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Contact</title>
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
        .form-card {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 1rem;
        }
        input[type="text"], input[type="email"] {
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
        <h2>Add New Contact</h2>
        <form method="POST" class="form-card">
            <input type="text" name="contact_name" placeholder="First Name" required>
            <input type="text" name="contact_surname" placeholder="Surname" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="text" name="client_code" placeholder="Client Code" required>
            <button type="submit" name="add">Add Contact</button>
        </form>

        <?php
        if (isset($_POST['add'])) {
            $name = trim($_POST['contact_name']);
            $surname = trim($_POST['contact_surname']);
            $email = trim($_POST['email']);
            $client_code = trim($_POST['client_code']);

            // Check if the client exists
            $check = $conn->prepare("SELECT * FROM client WHERE client_code = ?");
            $check->bind_param("s", $client_code);
            $check->execute();
            $result = $check->get_result();

            if ($result && $result->num_rows > 0) {
                // Client exists – proceed to add contact
                $stmt = $conn->prepare("INSERT INTO Contact (contact_name, contact_surname, email, client_code) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $name, $surname, $email, $client_code);

                if ($stmt->execute()) {
                    echo "<div class='result'>✅ Contact added successfully.</div>";
                } else {
                    echo "<div class='result'>❌ Error: " . $stmt->error . "</div>";
                }
            } else {
                // Client doesn't exist – show friendly error
                echo "<div class='result'>❌ Error: Client with code <strong>$client_code</strong> does not exist.</div>";
            }
        }
        ?>

        <a href="index.php" class="back-link">← Back to Home</a>
    </div>
</body>
</html>
