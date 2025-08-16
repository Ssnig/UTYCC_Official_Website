document.addEventListener('DOMContentLoaded', () => {
            const slidesContainer = document.getElementById('slides');
            const leftButton = document.getElementById('left-button');
            const rightButton = document.getElementById('right-button');
            const dotsContainer = document.getElementById('dots-container');
            const slides = document.querySelectorAll('.slide');
            const totalSlides = slides.length;
            let currentIndex = 0;
            let startX = 0;
            const touchThreshold = 50; // Minimum pixel distance for a swipe

            /**
             * Updates the position of the slider and the active dot.
             */
            const showSlide = (index) => {
                // Handle looping logic
                if (index >= totalSlides) {
                    currentIndex = 0;
                } else if (index < 0) {
                    currentIndex = totalSlides - 1;
                } else {
                    currentIndex = index;
                }
                
                // Move the slider
                const offset = -currentIndex * 100;
                slidesContainer.style.transform = `translateX(${offset}%)`;

                // Update active dot
                updateDots();
            };

            /**
             * Creates and updates the indicator dots.
             */
            const updateDots = () => {
                dotsContainer.innerHTML = '';
                for (let i = 0; i < totalSlides; i++) {
                    const dot = document.createElement('div');
                    dot.classList.add('dot');
                    if (i === currentIndex) {
                        dot.classList.add('active');
                    }
                    dot.addEventListener('click', () => {
                        showSlide(i);
                    });
                    dotsContainer.appendChild(dot);
                }
            };

            // Initial setup
            showSlide(0);

            // Add event listeners for navigation
            leftButton.addEventListener('click', () => {
                showSlide(currentIndex - 1);
            });

            rightButton.addEventListener('click', () => {
                showSlide(currentIndex + 1);
            });

            // Add touch event listeners for mobile swiping
            slidesContainer.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
            });

            slidesContainer.addEventListener('touchend', (e) => {
                const endX = e.changedTouches[0].clientX;
                const deltaX = endX - startX;

                if (deltaX > touchThreshold) {
                    // Swipe right
                    showSlide(currentIndex - 1);
                } else if (deltaX < -touchThreshold) {
                    // Swipe left
                    showSlide(currentIndex + 1);
                }
            });
        });