<!DOCTYPE html>
<html>
<head>
    <title>Add Client</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add New Client</h1>
        <form action="save-client.php" method="POST">
            <label>Client Name:</label>
            <input type="text" name="client_name" required>

            <label>Contact Code:</label>
            <input type="text" name="contact_code" required>

            <input type="submit" value="Save Client">
        </form>
    </div>
</body>
</html>
