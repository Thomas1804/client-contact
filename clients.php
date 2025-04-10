<?php
include 'connect.php';

// Fetch clients with their linked contact names using JOIN
$sql = "
    SELECT 
        Client.client_id, 
        Client.client_code, 
        Client.client_name, 
        Client.contact_code, 
        Contact.contact_name 
    FROM Client
    LEFT JOIN Contact ON Client.contact_code = Contact.contact_code
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Clients</title>
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
            max-width: 900px;
        }

        h1 {
            color: #4a2e1f;
            margin-bottom: 1rem;
        }

        .styled-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
            border: 1px solid #d6bfae;
            text-align: center;
        }

        .styled-table thead {
            background-color: #e4c9b5;
            color: #4a2e1f;
        }

        .styled-table tbody tr:nth-child(even) {
            background-color: #f3e5da;
        }

        .styled-table tbody tr:hover {
            background-color: #e6d5c4;
        }

        .btn-link {
            text-decoration: none;
            display: inline-block;
            margin-top: 1.5rem;
            background-color: #e4c9b5;
            color: #4a2e1f;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-link:hover {
            background-color: #d4b4a1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📂 All Clients</h1>

        <?php if ($result->num_rows > 0): ?>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client Code</th>
                        <th>Client Name</th>
                        <th>Contact Code</th>
                        <th>Contact Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['client_id'] ?></td>
                        <td><?= htmlspecialchars($row['client_code']) ?></td>
                        <td><?= htmlspecialchars($row['client_name']) ?></td>
                        <td><?= htmlspecialchars($row['contact_code']) ?></td>
                        <td><?= htmlspecialchars($row['contact_name'] ?? '—') ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No clients found.</p>
        <?php endif; ?>

        <a href="index.php" class="btn-link">🏠 Back to Home</a>
    </div>
</body>
</html>

<?php $conn->close(); ?>
