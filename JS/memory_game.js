// All JavaScript functions and variables are prefixed with 'memoryGameToast_'
// to ensure they are unique and do not conflict with your existing scripts.

const memoryGameToast_grid = document.getElementById('memoryGameToast_grid');
const memoryGameToast_scoreEl = document.getElementById('memoryGameToast_score');
const memoryGameToast_timerEl = document.getElementById('memoryGameToast_timer');
const memoryGameToast_overlay = document.getElementById('memoryGameToast_overlay');
const memoryGameToast_closeBtn = document.getElementById('memoryGameToast_closeBtn');
const memoryGameToast_endGameModal = document.getElementById('memoryGameToast_endGameModal');
const memoryGameToast_modalTitle = document.getElementById('memoryGameToast_modalTitle');
const memoryGameToast_playAgainBtn = document.getElementById('memoryGameToast_playAgainBtn');

// Replace these with your 14 image paths
const memoryGameToast_imageSources = [
    'https://placehold.co/100x100/f87171/ffffff?text=1',
    'https://placehold.co/100x100/fb923c/ffffff?text=2',
    'https://placehold.co/100x100/fbbf24/ffffff?text=3',
    'https://placehold.co/100x100/a3e635/ffffff?text=4',
    'https://placehold.co/100x100/4ade80/ffffff?text=5',
    'https://placehold.co/100x100/34d399/ffffff?text=6',
    'https://placehold.co/100x100/2dd4bf/ffffff?text=7',
    'https://placehold.co/100x100/60a5fa/ffffff?text=8',
    'https://placehold.co/100x100/818cf8/ffffff?text=9',
    'https://placehold.co/100x100/a78bfa/ffffff?text=10',
    'https://placehold.co/100x100/c084fc/ffffff?text=11',
    'https://placehold.co/100x100/e879f9/ffffff?text=12',
    'https://placehold.co/100x100/f472b6/ffffff?text=13',
    'https://placehold.co/100x100/78716c/ffffff?text=14'
];

let memoryGameToast_cards = [];
let memoryGameToast_hasFlippedCard = false;
let memoryGameToast_lockBoard = false;
let memoryGameToast_firstCard, memoryGameToast_secondCard;
let memoryGameToast_score = 0;
let memoryGameToast_matchesFound = 0;
let memoryGameToast_timer;
let memoryGameToast_timeLeft = 90; // 1 minute 30 seconds

function memoryGameToast_shuffle(array) {
    array.sort(() => Math.random() - 0.5);
}

function memoryGameToast_createBoard() {
    memoryGameToast_grid.innerHTML = '';
    const memoryGameToast_cardImages = [...memoryGameToast_imageSources, ...memoryGameToast_imageSources];
    memoryGameToast_shuffle(memoryGameToast_cardImages);

    memoryGameToast_cardImages.forEach(src => {
        const card = document.createElement('div');
        card.classList.add('memoryGameToast_card');
        card.dataset.framework = src;

        card.innerHTML = `
            <div class="memoryGameToast_card-face memoryGameToast_card-front">
                <img src="${src}" alt="Card Image">
            </div>
            <div class="memoryGameToast_card-face memoryGameToast_card-back">
                <div class="memoryGameToast_logo-placeholder"></div>
            </div>
        `;
        card.addEventListener('click', memoryGameToast_flipCard);
        memoryGameToast_grid.appendChild(card);
    });
    memoryGameToast_cards = document.querySelectorAll('.memoryGameToast_card');
}

function memoryGameToast_flipCard() {
    if (memoryGameToast_lockBoard) return;
    if (this === memoryGameToast_firstCard) return;

    this.classList.add('flip');

    if (!memoryGameToast_hasFlippedCard) {
        memoryGameToast_hasFlippedCard = true;
        memoryGameToast_firstCard = this;
        return;
    }

    memoryGameToast_secondCard = this;
    memoryGameToast_checkForMatch();
}

function memoryGameToast_checkForMatch() {
    let isMatch = memoryGameToast_firstCard.dataset.framework === memoryGameToast_secondCard.dataset.framework;
    isMatch ? memoryGameToast_disableCards() : memoryGameToast_unflipCards();
}

function memoryGameToast_disableCards() {
    memoryGameToast_firstCard.removeEventListener('click', memoryGameToast_flipCard);
    memoryGameToast_secondCard.removeEventListener('click', memoryGameToast_flipCard);
    
    memoryGameToast_score += 10;
    memoryGameToast_scoreEl.textContent = `Score: ${memoryGameToast_score}`;
    memoryGameToast_matchesFound++;
    
    if (memoryGameToast_matchesFound === memoryGameToast_imageSources.length) {
        memoryGameToast_endGame(true); // Player won
    }

    memoryGameToast_resetBoard();
}

function memoryGameToast_unflipCards() {
    memoryGameToast_lockBoard = true;
    setTimeout(() => {
        memoryGameToast_firstCard.classList.remove('flip');
        memoryGameToast_secondCard.classList.remove('flip');
        memoryGameToast_resetBoard();
    }, 1200);
}

function memoryGameToast_resetBoard() {
    [memoryGameToast_hasFlippedCard, memoryGameToast_lockBoard] = [false, false];
    [memoryGameToast_firstCard, memoryGameToast_secondCard] = [null, null];
}

function memoryGameToast_startTimer() {
    memoryGameToast_timeLeft = 90;
    memoryGameToast_timerEl.textContent = `Time: 1:30`;
    clearInterval(memoryGameToast_timer); // Clear any existing timer
    memoryGameToast_timer = setInterval(() => {
        memoryGameToast_timeLeft--;
        const minutes = Math.floor(memoryGameToast_timeLeft / 60);
        const seconds = memoryGameToast_timeLeft % 60;
        memoryGameToast_timerEl.textContent = `Time: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        if (memoryGameToast_timeLeft <= 0) {
            memoryGameToast_endGame(false); // Player lost
        }
    }, 1000);
}

function memoryGameToast_endGame(isWin) {
    clearInterval(memoryGameToast_timer);
    memoryGameToast_lockBoard = true;
    setTimeout(() => {
         if (isWin) {
            memoryGameToast_modalTitle.textContent = "Congratulations!";
            memoryGameToast_playAgainBtn.textContent = "Play Again";
        } else {
            memoryGameToast_modalTitle.textContent = "Time's Up!";
            memoryGameToast_playAgainBtn.textContent = "Try Again";
        }
        memoryGameToast_endGameModal.classList.add('active');
    }, 500);
}

function memoryGameToast_resetGame() {
    memoryGameToast_endGameModal.classList.remove('active');
    memoryGameToast_score = 0;
    memoryGameToast_matchesFound = 0;
    memoryGameToast_scoreEl.textContent = `Score: 0`;
    memoryGameToast_resetBoard();
    memoryGameToast_createBoard();
    memoryGameToast_startTimer();
}

// Functions to control the game's visibility
window.memoryGameToast_openGame = () => {
    memoryGameToast_overlay.classList.add('active');
    memoryGameToast_resetGame();
};

window.memoryGameToast_closeGame = () => {
    memoryGameToast_overlay.classList.remove('active');
    clearInterval(memoryGameToast_timer);
};

memoryGameToast_closeBtn.addEventListener('click', window.memoryGameToast_closeGame);
memoryGameToast_playAgainBtn.addEventListener('click', memoryGameToast_resetGame);

// Initialize the board on page load (optional, but good for setup)
memoryGameToast_createBoard();
