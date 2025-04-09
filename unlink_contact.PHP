<?php
include 'connect.php';
$id = $_GET['id'];
$query = "DELETE FROM Contact WHERE contact_id = $id";
$conn->query($query);
header("Location: index.php");
?>