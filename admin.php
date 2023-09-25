<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "audio_mass";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];

    
    $audio_dir = "audio/";
    $audio_file = $audio_dir . basename($_FILES["audio"]["name"]);

    if (move_uploaded_file($_FILES["audio"]["tmp_name"], $audio_file)) {
       
        $sql = "INSERT INTO podcast_episodes (title, audio_url) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $title, $audio_file);
        if ($stmt->execute()) {
            
            echo '<script>alert("Episode added successfully.");</script>';
        } else {
          
            echo '<script>alert("Error inserting data into the database: ' . $stmt->error . '");</script>';
        }
        $stmt->close();
    } else {

        echo '<script>alert("Error uploading the audio file.");</script>';
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'cdn.php'; ?>
    <title>Admin | Audio Mass Podcast</title>
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
                <h1>Admin Audio Mass Podcast</h1>
                <p>We explore the sacred realm of Catholic faith through the power of audio.</p>
            </div>
            <div class="forms-all">
                <form action="" method="post" enctype="multipart/form-data">

                    <div class="forms">
                        <label for="title">Episode Title:</label>
                        <input type="text" name="title" required>
                    </div>
                    <div class="forms">
                        <label for="audio">Audio File:</label>
                        <input type="file" name="audio" accept=".mp3" required>
                    </div>
                    <div class="forms">
                        <input type="submit" value="Add new podcast" class="submit">
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script src="./javascript/authenticate.js"></script>
</body>

</html>