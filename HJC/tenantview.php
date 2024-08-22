// Assume this is the login page for tenants
// Include necessary files (e.g., database connection, authentication functions)

// Check if the tenant is already logged in
if (isset($_SESSION['tenant_id'])) {
    // Redirect to the tenant dashboard or main page
    header('Location: tenant_dashboard.php');
    exit;
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Authenticate the tenant using your preferred method (e.g., database query)
    $tenant = authenticateTenant($username, $password);

    if ($tenant) {
        // Set the tenant ID in the session
        $_SESSION['tenant_id'] = $tenant['id'];
        // Redirect to the tenant dashboard or main page
        header('Location: tenant_dashboard.php');
        exit;
    } else {
        // Display an error message
        $error = 'Invalid username or password';
    }
}

// Display the login form
?>
<form action="" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username"><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Login">
</form>

<?php if (isset($error)) : ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>