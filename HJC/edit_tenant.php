<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $move_in_date = $_POST['move_in_date'];
    $lease_terms = $_POST['lease_terms'];
    $status = $_POST['status'];

    $sql = "UPDATE tenants SET name='$name', move_in_date='$move_in_date', lease_terms='$lease_terms', status='$status' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM tenants WHERE id=$id");
    $tenant = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tenant</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Tenant</h1>
    <form action="edit_tenant.php" method="post">
        <input type="hidden" name="id" value="<?php echo $tenant['id']; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $tenant['name']; ?>" required><br><br>
        <label for="move_in_date">Move-in Date:</label>
        <input type="date" id="move_in_date" name="move_in_date" value="<?php echo $tenant['move_in_date']; ?>" required><br><br>
        <label for="lease_terms">Lease Terms:</label>
        <input type="text" id="lease_terms" name="lease_terms" value="<?php echo $tenant['lease_terms']; ?>" required><br><br>
        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="Occupied" <?php if ($tenant['status'] == 'Occupied') echo 'selected'; ?>>Occupied</option>
            <option value="Vacant" <?php if ($tenant['status'] == 'Vacant') echo 'selected'; ?>>Vacant</option>
        </select><br><br>
        <button type="submit">Save Changes</button>
    </form>
</body>
</html>
