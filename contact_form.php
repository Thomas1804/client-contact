<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Contact</title>
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
        label {
            text-align: left;
            font-weight: bold;
            color: #4a2e1f;
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
        <form action="save_contact.php" method="POST" class="form-card">
            <label for="contact_name">First Name:</label>
            <input type="text" id="contact_name" name="contact_name" required>

            <label for="contact_surname">Surname:</label>
            <input type="text" id="contact_surname" name="contact_surname" required>

            <label for="contact_code">Contact Code:</label>
            <input type="text" id="contact_code" name="contact_code" required>

            <label for="client_code">Client Code:</label>
            <input type="text" id="client_code" name="client_code" required>

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>

            <button type="submit">Save Contact</button>
        </form>

        <a href="index.php" class="back-link">🏠 Back to Home</a>
    </div>
</body>
</html>
