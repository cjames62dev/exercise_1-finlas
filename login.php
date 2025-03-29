<?php
// Database connection details (SAME AS signup.php)
// ... (database connection code from signup.php) ...
<http://localhost/signup.php>

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = htmlspecialchars($_POST["username"]);
        $password = $_POST["password"];

        // Prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($password, $row["password"])) {
            session_start();
            $_SESSION["username"] = $username;
            echo "Login successful!";
        } else {
            echo "Invalid username or password.";
        }
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" value="Login">
</form>
