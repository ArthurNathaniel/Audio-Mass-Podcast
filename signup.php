<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit(); // Ensure that the script stops here after the redirect
    } else {
        echo "Error: " . $stmt->error;
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
    <title>Sign Up | Audio Mass Podcast</title>
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

            </div>
            <div class="form">
                <h1>Create an account</h1>
                <p>We're delighted to have you here as part of our growing community.</p>
            </div>
            <div class="forms-all">
                <form method="POST" action="">
                    <div class="forms">
                        <label>Username:</label>
                        <input type="text" name="username" placeholder="Enter your username" required>
                    </div>
                    <div class="forms">
                        <label>Email:</label>
                        <input type="email" name="email" placeholder="Enter your email address" required>
                    </div>
                    <div class="forms">
                        <label>Password:</label>
                        <input type="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="forms">
                        <input type="submit" value="Create Account" class="submit">
                    </div>
                    <div class="forms">
                        <a href="login.php" class="redirect">Login</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script src="./javascript/authenticate.js"></script>
</body>

</html>