<?php
include 'db.php';

$result = $conn->query("SELECT * FROM tenants");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 56px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Property Management System</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Tenants</h1>
        <form action="add_tenant.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" required><br><br>
            <label for="move_in_date">Move-in Date:</label>
            <input type="date" id="move_in_date" name="move_in_date" class="form-control" required><br><br>
            <label for="lease_terms">Lease Terms:</label>
            <input type="text" id="lease_terms" name="lease_terms" class="form-control" required><br><br>
            <label for="status">Status:</label>
            <select id="status" name="status" class="form-control" required>
                <option value="Occupied">Occupied</option>
                <option value="Vacant">Vacant</option>
            </select><br><br>
            <button type="submit" class="btn btn-primary">Add Tenant</button>
        </form>

        <ul class="list-group mt-4">
            <?php while ($row = $result->fetch_assoc()): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo $row['name']; ?> - Move-in Date: <?php echo $row['move_in_date']; ?> - Lease Terms: <?php echo $row['lease_terms']; ?> - Status: <?php echo $row['status']; ?>
                    <div>
                        <a href="edit_tenant.php?id=<?php echo $row['id']; ?>" class="btn btn-secondary">Edit</a>
                        <a href="delete_tenant.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                        <a href="view_payments.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">View Payments</a>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php $conn->close(); ?>

