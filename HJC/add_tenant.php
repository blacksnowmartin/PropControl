<?php
include 'db.php';

$name = $_POST['name'];
$move_in_date = $_POST['move_in_date'];
$lease_terms = $_POST['lease_terms'];
$status = $_POST['status'];

$sql = "INSERT INTO tenants (name, move_in_date, lease_terms, status) VALUES ('$name', '$move_in_date', '$lease_terms', '$status')";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
