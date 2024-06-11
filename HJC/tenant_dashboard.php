<?php
include 'db.php';
session_start();

if (!isset($_SESSION['tenant_id'])) {
    header("Location: login.php");
    exit();
}

$tenant_id = $_SESSION['tenant_id'];
$result = $conn->query("SELECT * FROM tenants WHERE id=$tenant_id");
$tenant = $result->fetch_assoc();

$payments_result = $conn->query("SELECT * FROM payments WHERE tenant_id=$tenant_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welcome, <?php echo $tenant['name']; ?></h1>
    <h2>Your Payments</h2>
    <ul>
        <?php while ($payment = $payments_result->fetch_assoc()): ?>
            <li>Amount: <?php echo $payment['amount']; ?> - Date: <?php echo $payment['date']; ?> - Status: <?php echo $payment['status']; ?></li>
        <?php endwhile; ?>
    </ul>

    <h2>Make a New Payment</h2>
    <form action="add_payment.php" method="post" id="payment-form">
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
        <label for="card-element">Credit or debit card</label>
        <div id="card-element"></div>
        <div id="card-errors" role="alert"></div><br><br>
        <button type="submit">Make Payment</button>
    </form>

    <script src="https://js.stripe.com/v3/"></script>
    <script src="script.js"></script>
</body>
</html>
<?php $conn->close(); ?>
