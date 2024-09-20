let slides = document.querySelectorAll('.testItem');
let dots = document.querySelectorAll('.dot');
let currentSlide = 0;
let interval;

// Function to switch between slides based on the clicked dot
function switchTest(currentDot) {
    let slideIndex = parseInt(currentDot.getAttribute('attr'));

    if (slideIndex > currentSlide) {
        slides[currentSlide].style.animation = 'next1 0.5s ease-in forwards';
    } else if (slideIndex < currentSlide) {
        slides[currentSlide].style.animation = 'prev1 0.5s ease-in forwards';
    }

    currentSlide = slideIndex;
    slides[currentSlide].style.animation = slideIndex > currentSlide ? 'next2 0.5s ease-in forwards' : 'prev2 0.5s ease-in forwards';
    updateIndicators();
}

// Update dot indicators to highlight the current slide
function updateIndicators() {
    dots.forEach(dot => dot.classList.remove('active'));
    dots[currentSlide].classList.add('active');
}

// Move to the next slide
function nextSlide() {
    slides[currentSlide].style.animation = 'next1 0.5s ease-in forwards';
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].style.animation = 'next2 0.5s ease-in forwards';
    updateIndicators();
}

// Move to the previous slide
function prevSlide() {
    slides[currentSlide].style.animation = 'prev1 0.5s ease-in forwards';
    currentSlide = (currentSlide === 0) ? slides.length - 1 : currentSlide - 1;
    slides[currentSlide].style.animation = 'prev2 0.5s ease-in forwards';
    updateIndicators();
}

// Automatically slide every 3 seconds
function startAutoSliding() {
    interval = setInterval(nextSlide, 3000);
}

// Stop auto sliding on mouseover and restart on mouseout
document.querySelector('.slider-controls').addEventListener('mouseover', () => clearInterval(interval));
document.querySelector('.slider-controls').addEventListener('mouseout', startAutoSliding);

// Initialize the automatic sliding
startAutoSliding();
