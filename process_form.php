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
    
    // Handle the audio file upload
    $audio_dir = "audio/";
    $audio_file = $audio_dir . basename($_FILES["audio"]["name"]);

    if (move_uploaded_file($_FILES["audio"]["tmp_name"], $audio_file)) {
        // Insert the episode information into the database
        $sql = "INSERT INTO podcast_episodes (title, audio_url) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $title, $audio_file);
        if ($stmt->execute()) {
            echo "Episode added successfully.";
        } else {
            echo "Error inserting data into the database: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error uploading the audio file.";
    }
}

$conn->close();
