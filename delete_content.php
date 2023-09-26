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

if (isset($_GET['id'])) {
    $contentId = $_GET['id'];

    // Check if the form for deleting content has been submitted.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Delete the content from the database.
        $deleteSql = "DELETE FROM podcast_episodes WHERE id = :id";
        $deleteStmt = $pdo->prepare($deleteSql);
        $deleteStmt->bindParam(':id', $contentId, PDO::PARAM_INT);

        if ($deleteStmt->execute()) {
            // Content deleted successfully.
            header("Location: edit_delete.php"); // Redirect to the content list page.
            exit();
        } else {
            echo "Error deleting content: " . $deleteStmt->errorInfo()[2];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'cdn.php'; ?>
    <title>Delete Content | Audio Mass Podcast</title>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/edit_delete.css">
</head>

<body>
    <div class="navbar-all">
        <div class="logo">

        </div>
        <div class="nav-btn">

        </div>
    </div>
    <div class="hero">
        <h1>Delete Content</h1>
    </div>
    <div class="delete-content">
        <h1>Delete Content</h1>
        <p>Are you sure you want to delete this content?</p>
        <form action="" method="post">
            <div class="form-group">
                <input type="submit" value="Delete" class="delete-button">
            </div>
        </form>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>