<?php
    include 'db.php';
    $tenant_id = $_GET['id'];
    $payments_result = $conn->query("SELECT * FROM payments WHERE tenant_id = $tenant_id");
    $tenant_result = $conn->query("SELECT * FROM tenants WHERE id = $tenant_id");
    $tenant = $tenant_result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payments for <?php echo $tenant['name']; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>Payments for <?php echo $tenant['name']; ?></h1>
            </div>
            <div class="card-body">
                <form action="add_payment.php" method="post" class="mb-4">
                    <input type="hidden" name="tenant_id" value="<?php echo $tenant_id; ?>">
                    <div class="form-group">
                        <label for="amount">Amount:</label>
                        <input type="text" id="amount" name="amount" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" id="date" name="date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="Paid">Paid</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Payment</button>
                </form>

                <ul class="list-group">
                    <?php while ($payment = $payments_result->fetch_assoc()): ?>
                        <li class="list-group-item">Amount: <?php echo $payment['amount']; ?> - Date: <?php echo $payment['date']; ?> - Status: <?php echo $payment['status']; ?></li>
                    <?php endwhile; ?>
                </ul>
            </div>
            <div class="card-footer">
                <a href="index.php" class="btn btn-secondary mt-3">Back to Tenants</a>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>

