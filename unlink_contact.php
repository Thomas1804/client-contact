<?php
include 'connect.php';

$contact_id = $_GET['contact_id'] ?? null;
$mode = $_GET['mode'] ?? 'unlink'; // Default to unlink

if ($contact_id && is_numeric($contact_id)) {
    if ($mode === 'delete') {
        $stmt = $conn->prepare("DELETE FROM Contact WHERE contact_id = ?");
    } else {
        $stmt = $conn->prepare("UPDATE Contact SET client_code = NULL WHERE contact_id = ?");
    }

    $stmt->bind_param("i", $contact_id);

    if ($stmt->execute()) {
        $status = $mode === 'delete' ? 'deleted' : 'unlinked';
        header("Location: contacts.php?status=$status");
        exit();
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "❌ Invalid contact ID.";
}

$conn->close();
?>
