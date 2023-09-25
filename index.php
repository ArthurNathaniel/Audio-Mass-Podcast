<?php
session_start();


if (isset($_SESSION['user_id'])) {

    $username = $_SESSION['username'];
} else {

    header("Location: login.php");
    exit();
}

// Include the database connection code here
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
    <title>Home | Audio Mass Podcast</title>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/home.css">
</head>

<body>
    <section>
        <div class="profile-all">
            <div class="profile-image">
            </div>
            <div class="profile-text">
                <div class="profile-info">
                    <h1>Hello <?php echo $_SESSION['username']; ?>!</h1>

                    <p>Welcome to the Audio Mass Podcast</p>
                </div>
                <div class="profile-icon">
                    <button>
                        <a href=""><i class="fa-solid fa-sack-dollar"></i> Donate</a>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide banner">Slide 1</div>
                <div class="swiper-slide banner">Slide 2</div>
                <div class="swiper-slide banner">Slide 3</div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <section>
        <div class="recent">
            <div class="title">
                <h1>Audio Mass Podcast</h1>
            </div>
            <div class="search">
                <input type="text" id="searchInput" placeholder="Search ...">
            </div>
        </div>
    </section>
    <div class="recently" id="podcastEpisodes">
        <?php

        $sql = "SELECT * FROM podcast_episodes ORDER BY timestamp DESC";
        $stmt = $pdo->query($sql);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="h-all">';
            echo '<div class="h-image">';

            echo '</div>';
            echo '<div class="h-text">';
            echo '<div class="h-info">';
            echo '<h3>' . htmlspecialchars($row["title"]) . '</h3>';


            $uploadTime = strtotime($row["timestamp"]);
            $currentTimestamp = time();

            $timeDifference = $currentTimestamp - $uploadTime;

            if ($timeDifference < 60) {

                $formattedTime = $timeDifference . ' sec ago';
            } elseif ($timeDifference < 3600) {

                $formattedTime = floor($timeDifference / 60) . ' min ago';
            } else {

                $formattedTime = floor($timeDifference / 3600) . ' hour ago';
            }

            echo '<p><i class="fa-solid fa-clock"></i> ' . $formattedTime . '</p>'; // Display the formatted time
            echo '</div>';
            echo '<div class="h-icon">';
            echo '<h1 class="play-btn" data-audio="' . htmlspecialchars($row["audio_url"]) .  '"><i class="fa-solid fa-circle-play circle"></i></h1>';
            echo '<br>';
            echo '<audio class="audio-element" controls>';
            echo '<source src="' . htmlspecialchars($row["audio_url"]) . '" type="audio/mpeg">';
            echo 'Your browser does not support the audio element.';
            echo '</audio>';
            echo '<br>';
            echo '<a href="' . htmlspecialchars($row["audio_url"]) . '" download class="download"><i class="fa-solid fa-circle-arrow-down circle"></i></a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>

    </div>

    <?php include 'footer.php'; ?>
    <script src="./javascript/home.js"></script>
    <script src="./javascript/search.js"></script>
    <script src="./javascript/play.js"></script>


</body>

</html>