<?php
include 'db.php';

$id = $_GET['id'];

$sql = "DELETE FROM tenants WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
