<?php
include 'db.php';

$tenant_id = $_GET['id'];
$result = $conn->query("SELECT * FROM tenants WHERE id=$tenant_id");
$tenant = $result->fetch_assoc();

$payments_result = $conn->query("SELECT * FROM payments WHERE tenant_id=$tenant_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Payments</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Payments for <?php echo $tenant['name']; ?></h1>
    <form action="add_payment.php" method="post">
        <input type="hidden" name="tenant_id" value="<?php echo $tenant_id; ?>">
        <label for="amount">Amount:</label>
        <input type="text" id="amount" name="amount" required><br><br>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required><br><br>
        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="Paid">Paid</option>
            <option value="Pending">Pending</option>
        </select><br><br>
        <button type="submit">Add Payment</button>
    </form>
    
    <ul>
        <?php while ($payment = $payments_result->fetch_assoc()): ?>
            <li>Amount: <?php echo $payment['amount']; ?> - Date: <?php echo $payment['date']; ?> - Status: <?php echo $payment['status']; ?></li>
        <?php endwhile; ?>
    </ul>
    <a href="index.php">Back to Tenants</a>
</body>
</html>
<?php $conn->close(); ?>
