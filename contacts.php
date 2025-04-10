<?php
include 'connect.php';

$sql = "SELECT * FROM Contact";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Contacts</title>
    <link rel="stylesheet" href="public/css/style.css"> <!-- Update this path if needed -->
    <style>
        body {
            background-color: #f8f1ec;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            background-color: #fff7f0;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
            width: 100%;
            max-width: 800px;
        }
        h1 {
            margin-bottom: 1rem;
            color: #4a2e1f;
        }
        .styled-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }
        .styled-table th,
        .styled-table td {
            padding: 12px;
            border: 1px solid #d6bfae;
            text-align: center;
        }
        .styled-table th {
            background-color: #e4c9b5;
            color: #4a2e1f;
        }
        .styled-table td {
            background-color: #fff;
        }
        .btn-link, .unlink-btn {
            display: inline-block;
            text-decoration: none;
            background-color: #b78c6f;
            color: white;
            padding: 0.6rem 1rem;
            border-radius: 8px;
            transition: background-color 0.3s;
        }
        .btn-link:hover, .unlink-btn:hover {
            background-color: #a7785f;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>📇 All Contacts</h1>

    <?php if ($result->num_rows > 0): ?>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Contact Name</th>
                    <th>Surname</th>
                    <th>Contact Code</th>
                    <th>Email</th>
                    <th>Client Code</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['contact_id'] ?></td>
                    <td><?= htmlspecialchars($row['contact_name']) ?></td>
                    <td><?= htmlspecialchars($row['contact_surname']) ?></td>
                    <td><?= htmlspecialchars($row['contact_code']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['client_code']) ?></td>
                    <td>
                        <a class="unlink-btn" href="unlink_contact.php?contact_id=<?= $row['contact_id'] ?>" onclick="return confirm('Are you sure you want to unlink this contact from its client?');">Unlink</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No contacts found.</p>
    <?php endif; ?>

    <a href="index.php" class="btn-link">← Back to Home</a>
</div>
</body>
</html>

<?php $conn->close(); ?>
