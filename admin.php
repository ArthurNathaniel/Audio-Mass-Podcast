<form action="process_form.php" method="post" enctype="multipart/form-data">
    <label for="title">Episode Title:</label>
    <input type="text" name="title" required><br>
    <label for="audio">Audio File:</label>
    <input type="file" name="audio" accept=".mp3" required><br>
    <input type="submit" value="Submit">
</form>