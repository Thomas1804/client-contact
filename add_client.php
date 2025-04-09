<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html>
<head><title>Add Client</title></head>
<body>
    <h2>Add New Client</h2>
    <form method="POST">
        Name: <input type="text" name="client_name" required><br>
        Code: <input type="text" name="client_code" maxlength="6" required><br>
        <button type="submit" name="add">Add Client</button>
    </form>

    <?php
    if (isset($_POST['add'])) {
        $name = $_POST['client_name'];
        $code = $_POST['client_code'];
        $stmt = $conn->prepare("INSERT INTO Client (client_name, client_code) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $code);
        if ($stmt->execute()) {
            echo "Client added. <a href='index.php'>Back to Search</a>";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    ?>
</body>
</html>