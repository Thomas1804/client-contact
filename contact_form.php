<!DOCTYPE html>
<html>
<head>
    <title>Add Contact</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Add New Contact</h1>
    <form action="save_contact.php" method="POST">
        <label>Contact Name:</label>
        <input type="text" name="contact_name" required>

        <label>Contact Surname:</label>
        <input type="text" name="contact_surname" required>

        <label>Contact Code:</label>
        <input type="text" name="contact_code" required>

        <label>Client Code:</label>
        <input type="text" name="client_code" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <input type="submit" value="Save Contact">
    </form>
</div>
</body>
</html>
