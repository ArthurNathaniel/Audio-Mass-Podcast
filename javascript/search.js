// Get the search input element
const searchInput = document.getElementById("searchInput");

// Get the podcast episodes container
const podcastEpisodes = document.getElementById("podcastEpisodes");

// Get all podcast episode elements
const episodeElements = podcastEpisodes.getElementsByClassName("h-all");

// Create an array to store the original display style of each episode
const originalDisplay = Array.from(episodeElements).map((element) => {
  return window.getComputedStyle(element).display;
});

// Listen for input changes in the search box
searchInput.addEventListener("input", function () {
  const searchTerm = searchInput.value.toLowerCase();

  // Loop through the episode elements and hide/show based on search term
  for (let i = 0; i < episodeElements.length; i++) {
    const episode = episodeElements[i];
    const episodeTitle = episode.querySelector("h3").textContent.toLowerCase();

    if (episodeTitle.includes(searchTerm)) {
      episode.style.display = originalDisplay[i]; // Show matching episodes
    } else {
      episode.style.display = "none"; // Hide non-matching episodes
    }
  }
});
