// Get all play buttons
const playButtons = document.querySelectorAll(".play-btn");
const audioElements = document.querySelectorAll(".audio-element");

// Add a click event listener to each play button
playButtons.forEach((button, index) => {
  button.addEventListener("click", function () {
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
