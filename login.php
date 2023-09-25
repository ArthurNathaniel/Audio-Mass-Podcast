<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Password is correct, create a session and set the user_id and username
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            header("Location: home.php");
            exit(); // Ensure that the script stops here after the redirect
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'cdn.php'; ?>
    <title>Login | Audio Mass Podcast</title>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/authenticate.css">
</head>

<body>
    <div class="page-all">
        <div class="page-swiper">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide aass">Slide 1</div>
                    <div class="swiper-slide aass">Slide 2</div>
                </div>
                <div class="box-swipper">
                    <button class="fa-solid fa-arrow-right prev"></button>
                    <button class="fa-solid fa-arrow-left  next"></button>
                </div>
            </div>
        </div>
        <div class="page-form">
            <div class="page-logo">
                <!-- Add your logo or branding here -->
            </div>
            <div class="form">
                <h1>Login into your account</h1>
                <p>We're delighted to have you here as part of our growing community.</p>
            </div>
            <div class="forms-all">
                <form method="POST" action="">
                    <div class="forms">
                        <label>Username:</label>
                        <input type="text" name="username" placeholder="Enter your username" required>
                    </div>
                    <div class="forms">
                        <label>Password:</label>
                        <input type="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="forms">
                        <input type="submit" value="Login" class="submit">
                    </div>
                    <div class="forms">
                        <a href="signup.php" class="redirect">Create Account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="./javascript/authenticate.js"></script>
</body>

</html>