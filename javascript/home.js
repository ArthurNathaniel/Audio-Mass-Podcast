var swiper = new Swiper(".mySwiper", {
  spaceBetween: 30,
  centeredSlides: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
  loop: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});

var paginationBullets = document.querySelectorAll(".swiper-pagination-bullet");

paginationBullets.forEach(function (bullet) {
  bullet.style.backgroundColor = "white"; 
});
