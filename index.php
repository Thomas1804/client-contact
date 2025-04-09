<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html>
<head><title>Client Search</title></head>
<body>
<ul>
    <li><a href="client_form.php">➕ Add New Client</a></li>
    <li><a href="contact_form.php">➕ Add New Contact</a></li>
    <li><a href="clients.php">📂 View All Clients</a></li>
</ul>

    <h2>Search Client</h2>
    <form method="GET">
        <input type="text" name="client_code" placeholder="Client Code" required>
        <button type="submit">Search</button>
    </form>
    <a href="add_client.php">Add New Client</a>

    <?php
    if (isset($_GET['client_code'])) {
        $code = $_GET['client_code'];
        $query = "SELECT * FROM Client WHERE client_code = '$code'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $client = $result->fetch_assoc();
            echo "<h3>Main Client</h3>";
            echo "Name: " . $client['client_name'] . "<br>";
            echo "Client Code: " . $client['client_code'] . "<br><br>";

            $contact_query = "SELECT * FROM Contact WHERE client_code = '$code'";
            $contact_result = $conn->query($contact_query);
            echo "<strong>Contacts:</strong><br>";
            while ($contact = $contact_result->fetch_assoc()) {
                echo $contact['contact_name'] . " " . $contact['contact_surname'] . " - " . $contact['email'];
                echo " <a href='unlink_contact.php?id=" . $contact['contact_id'] . "'>Unlink</a><br>";
            }

            echo "<br><a href='add_contact.php?client_code=$code'>Add New Contact</a>";
        } else {
            echo "Client not found.";
        }
    }
    ?>
</body>
</html>