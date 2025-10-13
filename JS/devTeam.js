document.addEventListener('DOMContentLoaded', () => {
    const cards = Array.from(document.querySelectorAll('.team-card'));

    const closeAllCards = (exception) => {
        cards.forEach((card) => {
            if (card === exception) {
                return;
            }
            toggleCardState(card, false);
        });
    };

    const toggleCardState = (card, shouldOpen) => {
        const toggleButton = card.querySelector('.card-toggle');
        const detail = card.querySelector('.card-detail');
        if (!toggleButton || !detail) {
            return;
        }

        const isOpen = typeof shouldOpen === 'boolean' ? shouldOpen : !card.classList.contains('is-open');
        if (isOpen) {
            card.classList.add('is-open');
        } else {
            card.classList.remove('is-open');
        }

        toggleButton.setAttribute('aria-expanded', String(isOpen));
        detail.setAttribute('aria-hidden', String(!isOpen));
    };

    cards.forEach((card) => {
        const toggleButton = card.querySelector('.card-toggle');
        const detail = card.querySelector('.card-detail');
        if (!toggleButton || !detail) {
            return;
        }

        toggleButton.setAttribute('aria-expanded', 'false');
        detail.setAttribute('aria-hidden', 'true');

        toggleButton.addEventListener('click', (event) => {
            event.preventDefault();
            event.stopPropagation();
            const shouldOpen = !card.classList.contains('is-open');
            closeAllCards(card);
            toggleCardState(card, shouldOpen);
        });

        card.addEventListener('mouseenter', () => {
            closeAllCards(card);
        });

        card.addEventListener('focusin', () => {
            closeAllCards(card);
        });
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeAllCards();
        }
    });

    document.addEventListener('click', (event) => {
        if (!event.target.closest('.team-card')) {
            closeAllCards();
        }
    });
});
