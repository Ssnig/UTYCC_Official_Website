document.addEventListener('DOMContentLoaded', function() {
    // Hero carousel functionality
    const slides = document.querySelectorAll('.hero-slide');
    const dotsContainer = document.createElement('div');
    dotsContainer.className = 'hero-dots';
    let currentSlide = 0;
    const slideInterval = 5000; // 5 seconds
    
    // Create navigation dots
    slides.forEach((slide, index) => {
        const dot = document.createElement('div');
        dot.className = 'hero-dot';
        if (index === 0) dot.classList.add('active');
        dot.addEventListener('click', () => {
            goToSlide(index);
        });
        dotsContainer.appendChild(dot);
    });
    
    // Add dots to hero container
    document.querySelector('.hero-container').appendChild(dotsContainer);
    const dots = document.querySelectorAll('.hero-dot');
    
    function goToSlide(index) {
        slides[currentSlide].classList.remove('active');
        dots[currentSlide].classList.remove('active');
        currentSlide = (index + slides.length) % slides.length; // Ensure positive index
        slides[currentSlide].classList.add('active');
        dots[currentSlide].classList.add('active');
    }
    
    function nextSlide() {
        goToSlide(currentSlide + 1);
    }
    
    // Start the slideshow
    let slideShow = setInterval(nextSlide, slideInterval);
    
    // Pause on hover
    const heroContainer = document.querySelector('.hero-container');
    heroContainer.addEventListener('mouseenter', () => {
        clearInterval(slideShow);
    });
    
    heroContainer.addEventListener('mouseleave', () => {
        slideShow = setInterval(nextSlide, slideInterval);
    });
    
    // Optional: Touch support for mobile
    let touchStartX = 0;
    let touchEndX = 0;
    
    heroContainer.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
        clearInterval(slideShow);
    }, {passive: true});
    
    heroContainer.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
        slideShow = setInterval(nextSlide, slideInterval);
    }, {passive: true});
    
    function handleSwipe() {
        if (touchEndX < touchStartX - 50) {
            nextSlide(); // Swipe left
        }
        if (touchEndX > touchStartX + 50) {
            goToSlide(currentSlide - 1); // Swipe right
        }
    }
});