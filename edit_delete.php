<?php
session_start();

if (isset($_SESSION['user_id'])) {
    $username = $_SESSION['username'];
} else {
    header("Location: login.php"); // Redirect to login page if not logged in.
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "audio_mass";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'cdn.php'; ?>
    <title>Edit and Delete Content | Audio Mass Podcast</title>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/edit_delete.css">
    <link rel="stylesheet" href="./css/home.css">
</head>

<body>
    <div class="navbar-all">
        <div class="logo">

        </div>
        <div class="nav-btn">

        </div>
    </div>
    <div class="hero">
        <h1>Edit & Delete Content</h1>
    </div>
    <div class="content-edit-delete">
        <h1>Edit and Delete Content</h1>
        <?php
        // Retrieve content from the database and display it in a form for editing/deleting.
        $sql = "SELECT * FROM podcast_episodes"; // Adjust the SQL query based on your requirements.
        $stmt = $pdo->query($sql);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="content-item">';
            echo '<h2>' . htmlspecialchars($row["title"]) . '</h2>';
            echo '<audio controls class="audio">';
            echo '<source src="' . htmlspecialchars($row["audio_url"]) . '" type="audio/mpeg">';
            echo 'Your browser does not support the audio element.';
            echo '</audio>';
            echo '<p ><a href="edit_content.php?id=' . $row["id"] . '" class="cc"><i class="fa-regular fa-pen-to-square"></i> Edit</a>  <a href="delete_content.php?id=' . $row["id"] . '" class="cv"><i class="fa-solid fa-trash-can"></i> Delete</a></p>';
            echo '</div>';
        }
        ?>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>