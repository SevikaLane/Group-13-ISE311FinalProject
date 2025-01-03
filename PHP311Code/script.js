let slideIndex = 0;
const slides = document.querySelectorAll(".slide");
const dots = document.querySelectorAll(".dot");

// Show initial slide
showSlide(slideIndex);

// Function to change slides using arrows
function changeSlide(n) {
    slideIndex += n;
    showSlide(slideIndex);
}

// Function to go to a specific slide using dots
function currentSlide(n) {
    slideIndex = n - 1; // Convert to zero-based index
    showSlide(slideIndex);
}

// Main function to display slides
function showSlide(index) {
    // Loop back if at the end/start
    if (index >= slides.length) slideIndex = 0;
    if (index < 0) slideIndex = slides.length - 1;

    // Hide all slides and remove "active" dot
    slides.forEach(slide => (slide.style.display = "none"));
    dots.forEach(dot => dot.classList.remove("active"));

    // Show the current slide and activate corresponding dot
    slides[slideIndex].style.display = "block";
    dots[slideIndex].classList.add("active");
}

// Optional: Auto-advance slides every 3 seconds
setInterval(() => changeSlide(1), 3000);

