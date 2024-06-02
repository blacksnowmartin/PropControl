<?php
include 'db.php';

$tenant_id = $_POST['tenant_id'];
$amount = $_POST['amount'];
$date = $_POST['date'];
$status = $_POST['status'];

$sql = "INSERT INTO payments (tenant_id, amount, date, status) VALUES ('$tenant_id', '$amount', '$date', '$status')";

if ($conn->query($sql) === TRUE) {
    header("Location: view_payments.php?id=$tenant_id");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
