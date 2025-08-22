document.addEventListener('DOMContentLoaded', () => {
            const descriptionBox = document.getElementById('descriptionBox');
            const skillCards = document.querySelectorAll('.group');

            skillCards.forEach(card => {
                const description = card.getAttribute('data-description');

                card.addEventListener('mouseenter', () => {
                    descriptionBox.textContent = description;
                    descriptionBox.classList.remove('opacity-0');
                    descriptionBox.classList.add('opacity-100');
                });

                card.addEventListener('mouseleave', () => {
                    descriptionBox.classList.remove('opacity-100');
                    descriptionBox.classList.add('opacity-0');
                    // Reset the text after the transition is complete
                    setTimeout(() => {
                        if (descriptionBox.classList.contains('opacity-0')) {
                            descriptionBox.textContent = 'Hover over a skill to see a brief description.';
                        }
                    }, 300);
                });
            });
        });

        