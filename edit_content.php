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

    // Retrieve the content to be edited from the database.
    $sql = "SELECT * FROM podcast_episodes WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $contentId, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        // Content with the given ID not found.
        header("Location: edit_delete.php"); // Redirect to the content list page.
        exit();
    }

    // Check if the form for editing content has been submitted.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $newTitle = $_POST["new_title"];

        // Update the content in the database.
        $updateSql = "UPDATE podcast_episodes SET title = :title WHERE id = :id";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->bindParam(':title', $newTitle, PDO::PARAM_STR);
        $updateStmt->bindParam(':id', $contentId, PDO::PARAM_INT);

        if ($updateStmt->execute()) {
            // Content updated successfully.
            header("Location: edit_delete.php"); // Redirect to the content list page.
            exit();
        } else {
            echo "Error updating content: " . $updateStmt->errorInfo()[2];
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
    <title>Edit Content | Audio Mass Podcast</title>
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
        <h1>Edit Content</h1>
    </div>
    <div class="edit-content">


        <h1>Edit Content</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="new_title">New Title:</label>
                <input type="text" name="new_title" value="<?php echo htmlspecialchars($row["title"]); ?>" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Save Changes" class="submit">
            </div>
        </form>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>