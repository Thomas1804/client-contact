<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html>
<head><title>Add Contact</title></head>
<body>
    <?php $client_code = $_GET['client_code']; ?>
    <h2>Add New Contact for Client: <?= htmlspecialchars($client_code) ?></h2>
    <form method="POST">
        First Name: <input type="text" name="contact_name" required><br>
        Surname: <input type="text" name="contact_surname" required><br>
        Contact Code: <input type="text" name="contact_code" maxlength="6" required><br>
        Email: <input type="email" name="email" required><br>
        <button type="submit" name="save">Save Contact</button>
    </form>

    <?php
    if (isset($_POST['save'])) {
        $name = $_POST['contact_name'];
        $surname = $_POST['contact_surname'];
        $code = $_POST['contact_code'];
        $email = $_POST['email'];
        $stmt = $conn->prepare("INSERT INTO Contact (contact_name, contact_surname, contact_code, client_code, email) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $surname, $code, $client_code, $email);
        if ($stmt->execute()) {
            echo "Contact added. <a href='index.php?client_code=$client_code'>Back to Client</a>";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    ?>
</body>
</html>