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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Tenants</h1>
    <form action="add_tenant.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="move_in_date">Move-in Date:</label>
        <input type="date" id="move_in_date" name="move_in_date" required><br><br>
        <label for="lease_terms">Lease Terms:</label>
        <input type="text" id="lease_terms" name="lease_terms" required><br><br>
        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="Occupied">Occupied</option>
            <option value="Vacant">Vacant</option>
        </select><br><br>
        <button type="submit">Add Tenant</button>
    </form>

    <ul>
        <?php while ($row = $result->fetch_assoc()): ?>
            <li>
                <?php echo $row['name']; ?> - Move-in Date: <?php echo $row['move_in_date']; ?> - Lease Terms: <?php echo $row['lease_terms']; ?> - Status: <?php echo $row['status']; ?>
                <a href="edit_tenant.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                <a href="delete_tenant.php?id=<?php echo $row['id']; ?>">Delete</a> | 
                <a href="view_payments.php?id=<?php echo $row['id']; ?>">View Payments</a>
            </li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
<?php $conn->close(); ?>
