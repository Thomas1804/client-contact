<?php
include 'connect.php';

$sql = "SELECT * FROM Client";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Clients</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>📂 All Clients</h1>
    <table border="1" width="100%" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Client Code</th>
            <th>Client Name</th>
            <th>Contact Code</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['client_id'] ?></td>
            <td><?= $row['client_code'] ?></td>
            <td><?= $row['client_name'] ?></td>
            <td><?= $row['contact_code'] ?></td>
        </tr>
        <?php } ?>
    </table>
    <br>
    <a href="index.php">← Back to Home</a>
</div>
</body>
</html>

<?php
$conn->close();
?>
