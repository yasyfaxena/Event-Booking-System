<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Siapkan pernyataan SQL
        $stmt = $conn->prepare("SELECT id, email, password, role FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) { // Verifikasi password
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['role'] = $row['role'];

                echo "Login successful!";
                if ($row['role'] == 'admin') {
                    header("Location: admin.php"); // Halaman admin
                } else {
                    header("Location: home.php"); // Halaman pengguna
                }
                exit();
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No user found with this email.";
        }
        $stmt->close();
    } else {
        echo "Please fill out both fields.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="container">
        <div class="head">
            <img src="logo3.png" alt="">
            <p>Untuk tetap terhubung dengan kami, silahkan masuk dengan akun anda</p>
        </div>
        <div class="login">
            <h2>Log In</h2>
            <form action="login.php" method="post">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <a href="">Forgot Password?</a>
                <button type="submit" class="login-btn">LOG IN</button>
            </form>
            <div class="signup-link">
                Don't have an account? <a href="register.php">Sign In</a>
            </div>
        </div>
    </div>
</body>

</html>