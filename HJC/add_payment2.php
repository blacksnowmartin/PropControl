<?php
include 'db.php';
include 'stripe_config.php';

$tenant_id = $_POST['tenant_id'];
$amount = $_POST['amount'];
$date = $_POST['date'];
$status = $_POST['status'];
$payment_method = 'Stripe';

try {
    $charge = \Stripe\Charge::create([
        'amount' => $amount * 100, // Stripe expects the amount in cents
        'currency' => 'usd',
        'source' => $_POST['stripeToken'],
        'description' => "Rent payment for tenant ID: $tenant_id",
    ]);

    $transaction_id = $charge->id;
    $payment_timestamp = date('Y-m-d H:i:s', $charge->created);

    $sql = "INSERT INTO payments (tenant_id, amount, date, status, transaction_id, payment_method, payment_timestamp) VALUES ('$tenant_id', '$amount', '$date', '$status', '$transaction_id', '$payment_method', '$payment_timestamp')";

    if ($conn->query($sql) === TRUE) {
        header("Location: tenant_dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo 'Payment failed: ' . $e->getMessage();
}

$conn->close();
?>

