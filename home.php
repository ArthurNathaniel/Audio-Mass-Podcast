<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // User is logged in, get the username from the session
    $username = $_SESSION['username'];
} else {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit(); // Ensure that the script stops here
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
                <!-- You can add a user profile image here if needed -->
            </div>
            <div class="profile-text">
                <div class="profile-info">
                    <h1>Hello <?php echo $username; ?>!</h1>
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
                <input type="text" placeholder="Search ...">
            </div>
        </div>
    </section>
    <div class="recently">
        <?php
        // Retrieve podcast episodes from the database
        $sql = "SELECT * FROM podcast_episodes";
        $stmt = $pdo->query($sql);

        // Display episodes with audio playback and download links
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="h-all">';
            echo '<div class="h-image">';
            // Add an image for the podcast episode if needed
            echo '</div>';
            echo '<div class="h-text">';
            echo '<div class="h-info">';
            echo '<h3>' . htmlspecialchars($row["title"]) . '</h3>';
            echo '</div>';
            echo '<div class="h-icon">';
            echo '<h1 class="play-btn" data-audio="' . htmlspecialchars($row["audio_url"]) . '"><i class="fa-solid fa-circle-play"></i></h1>';
            echo '<br>';
            echo '<audio class="audio-element" controls>';
            echo '<source src="' . htmlspecialchars($row["audio_url"]) . '" type="audio/mpeg">';
            echo 'Your browser does not support the audio element.';
            echo '</audio>';
            echo '<br>';
            echo '<a href="' . htmlspecialchars($row["audio_url"]) . '" download><i class="fa-solid fa-circle-arrow-down"></i></a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>
        <!-- Add more podcast episode content as needed -->
    </div>
    <?php include 'footer.php'; ?>
    <script src="./javascript/home.js"></script>
    <script>
        // Get all play buttons
        const playButtons = document.querySelectorAll('.play-btn');
        const audioElements = document.querySelectorAll('.audio-element');

        // Add a click event listener to each play button
        playButtons.forEach((button, index) => {
            button.addEventListener('click', function() {
                // Find the corresponding audio element
                const audioElement = audioElements[index];

                // Check if the audio is paused or ended, then play it
                if (audioElement.paused || audioElement.ended) {
                    audioElement.play();
                    button.innerHTML = '<i class="fa-solid fa-pause"></i>';
                } else {
                    audioElement.pause();
                    button.innerHTML = '<i class="fa-solid fa-circle-play"></i>';
                }
            });
        });
    </script>
</body>

</html>

<style>
   
</style>