<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Client Search</title>
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
        form {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }
        input[type="text"] {
            flex: 1;
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
        .actions {
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
            margin-top: 2rem;
        }
        .actions a {
            text-decoration: none;
            background-color: #e4c9b5;
            color: #4a2e1f;
            padding: 0.8rem;
            border-radius: 8px;
            font-weight: bold;
            transition: background 0.3s;
        }
        .actions a:hover {
            background-color: #d4b4a1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Search for Client</h2>
        <form method="GET">
            <input type="text" name="client_code" placeholder="Enter Client Code" required>
            <button type="submit">Search</button>
        </form>

        <?php
        if (isset($_GET['client_code'])) {
            $code = $conn->real_escape_string($_GET['client_code']);
            $query = "SELECT * FROM client WHERE client_code = '$code'";
            $result = $conn->query($query);

            if ($result && $result->num_rows > 0) {
                $client = $result->fetch_assoc();
                echo "<div class='result'><strong>Client Found:</strong><br>";
                echo "Name: " . htmlspecialchars($client['client_name']) . "<br>";
                echo "Code: " . htmlspecialchars($client['client_code']) . "</div>";
            } else {
                echo "<div class='result'>❌ No client found with code <strong>" . htmlspecialchars($code) . "</strong>.</div>";
            }
        }
        ?>

        <div class="actions">
            <a href="client_form.php">➕ Add New Client</a>
            <a href="contact_form.php">➕ Add New Contact</a>
            <a href="clients.php">📂 View All Clients</a>
            <a href="contacts.php">📇 View All Contacts</a>
        </div>
    </div>
</body>
</html>
