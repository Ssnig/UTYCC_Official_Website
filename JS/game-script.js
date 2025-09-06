document.addEventListener('DOMContentLoaded', () => {

    // --- Toast Elements & Logic ---
    const gameToast = document.getElementById('sj-game-toast');
    const toastYesBtn = document.getElementById('sj-game-toast-yes');
    const toastNoBtn = document.getElementById('sj-game-toast-no');
    let isCountingDown = false;


    let toastTimeout;
    let toastInterval;
    let preventToast = false;

    const showToast = () => {
        if (preventToast) return;
        gameToast.classList.remove('sj-game-toast-hidden');
        // Auto-hide after 10 seconds
        toastTimeout = setTimeout(hideToast, 10000);
    };

    const hideToast = () => {
        clearTimeout(toastTimeout);
        gameToast.classList.add('sj-game-toast-hidden');
    };

    const startToastTimer = () => {
        // Show initial toast after 1 minute
        setTimeout(() => {
            showToast();
            // Then show every minute after that
            toastInterval = setInterval(showToast, 60000);
        }, 60000);
    };

    toastYesBtn.addEventListener('click', () => {
        preventToast = true;
        clearInterval(toastInterval);
        hideToast();
        showGameModal();
    });

    toastNoBtn.addEventListener('click', () => {
        preventToast = true;
        clearInterval(toastInterval);
        hideToast();
    });

    // --- Game Modal Elements & Logic ---
    const gameModalOverlay = document.getElementById('sj-game-modal-overlay');
    const closeTopBtn = document.getElementById('sj-game-modal-close-top');
    const closeBottomBtn = document.getElementById('sj-game-modal-close-bottom');
    const playAgainBtn = document.getElementById('sj-game-play-again');
    const gameOverScreen = document.getElementById('sj-game-over-screen');
    const countdownEl = document.getElementById('sj-game-countdown');

    let countdownInterval; // Moved to a higher scope to be cleared properly

    const showGameModal = () => {
        gameModalOverlay.classList.remove('sj-game-modal-hidden');
        initGame(); // Initialize and start the game
    };

    const hideGameModal = () => {
        gameover = true; // This will stop the animation loop
        clearInterval(countdownInterval); // Clear countdown if modal is closed mid-way
        gameModalOverlay.classList.add('sj-game-modal-hidden');
    };

    closeTopBtn.addEventListener('click', hideGameModal);
    closeBottomBtn.addEventListener('click', hideGameModal);
    playAgainBtn.addEventListener('click', () => { // <-- hide it again
    initGame();
    gameOverScreen.classList.add('sj-game-over-hidden');
});



    // --- Game Engine ---
    const canvas = document.getElementById('sj-game-canvas');
    const ctx = canvas.getContext('2d');
    const scoreEl = document.getElementById('sj-game-score');
    const highScoreEl = document.getElementById('sj-game-highScore');
    const touchControls = document.querySelector('.sj-game-touch-controls');


    let canvasWidth, canvasHeight;

    function resizeCanvas() {
        const modalContent = document.getElementById('sj-game-modal-content');
        canvasWidth = modalContent.clientWidth;
        canvasHeight = canvasWidth * (3 / 4);
        canvas.width = canvasWidth;
        canvas.height = canvasHeight;
    }


    let gravity = 0.5;
    let score = 0;
    let highScore = localStorage.getItem('superJumperHighScore') || 0;
    let gameover = false;
    let platforms = [];
    let platformCount = 4;
    let scrollOffset = 0;
    let player; // Declare player here

    highScoreEl.innerText = highScore;

    const keys = {
        right: { pressed: false },
        left: { pressed: false }
    };

    class Player {
        constructor() {
            this.position = { x: 100, y: 100 };
            this.velocity = { x: 0, y: 0 };
            this.width = canvasWidth * 0.06; // Responsive size
            this.height = this.width;
            this.speed = 7;
            this.jumpForce = 12;
        }

        draw() {
            ctx.fillStyle = '#ffffff';
            ctx.strokeStyle = '#0284c7';
            ctx.lineWidth = 3;
            ctx.strokeRect(this.position.x, this.position.y, this.width, this.height);
            ctx.fillRect(this.position.x, this.position.y, this.width, this.height);
        }

        update() {
            this.draw();
            this.position.x += this.velocity.x;
            this.position.y += this.velocity.y;

            if (this.position.y + this.height + this.velocity.y <= canvas.height) {
                this.velocity.y += gravity;
            }

            if (this.position.x > canvas.width) this.position.x = -this.width;
            else if (this.position.x + this.width < 0) this.position.x = canvas.width;
        }
    }

    class Platform {
        constructor({ x, y, type = 'normal' }) {
            this.position = { x, y };
            this.width = canvasWidth * 0.2; // Responsive
            this.height = 15;
            this.type = type;
            this.image = null; // Placeholder for image
            if (this.type === 'tube') {
                
                this.image = new Image();
                this.image.src = '../Img/logo/utycc_logo.png'; // Local image path
                this.height = 40; // Taller for tubes
            }
        }

        draw() {
            if (this.type === 'tube' && this.image && this.image.complete) {
                ctx.drawImage(this.image, this.position.x, this.position.y, this.width, this.height);
            } else if (this.type === 'tube') {
                // Fallback drawing for the tube if no image is linked
                ctx.fillStyle = '#22c55e'; // Green for tube
                ctx.fillRect(this.position.x, this.position.y, this.width, this.height);
                ctx.fillStyle = '#16a34a';
                ctx.fillRect(this.position.x, this.position.y, this.width, 5);
                ctx.fillRect(this.position.x, this.position.y + this.height - 5, this.width, 5);
            }
            else {
                ctx.fillStyle = '#0284c7';
                ctx.strokeStyle = '#0369a1';
                ctx.lineWidth = 2;
                ctx.fillRect(this.position.x, this.position.y, this.width, this.height);
                ctx.strokeRect(this.position.x, this.position.y, this.width, this.height);
            }
        }
    }

    function initGame() {
        gameOverScreen.classList.add('sj-game-over-hidden');
        resizeCanvas();
        gameover = true; // Pause game for countdown
        score = 0;
        scrollOffset = 0;
        scoreEl.innerText = score;
        player = new Player();
        platforms = [];

        for (let i = 0; i < platformCount; i++) {
            let platGap = canvasHeight / 5;
            let newPlatY = canvas.height - 75 - (i * platGap);
            let platformType = Math.random() > 0.9 ? 'tube' : 'normal';
            platforms.push(new Platform({
                x: Math.random() * (canvas.width - 100),
                y: newPlatY,
                type: platformType
            }));
        }
        platforms[0].position.x = player.position.x - 30;
        platforms[0].position.y = canvas.height - 50;
        platforms[0].type = 'normal';

        // Draw the initial scene so it's visible during countdown
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        platforms.forEach(platform => {
            platform.draw();
        });
        player.draw();

        startCountdown();
    }

    function startCountdown() {
        clearInterval(countdownInterval);
        countdownEl.classList.remove('sj-game-countdown-hidden');
        let count = 3;
        countdownEl.innerText = count;
        isCountingDown = true; // ⬅️ important

        countdownInterval = setInterval(() => {
            count--;
            if (count > 0) {
                countdownEl.innerText = count;
            } else {
                clearInterval(countdownInterval);
                countdownEl.classList.add('sj-game-countdown-hidden');
                isCountingDown = false; // ⬅️ allow game to start
                gameover = false;
                animate();
            }
        }, 1000);
    }



    function animate() {
        if (gameover) return;

        requestAnimationFrame(animate);
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        player.update();

        // Prevent falling gameover while counting down
        if (!isCountingDown && player.position.y > canvas.height) {
            gameover = true;
            gameOverScreen.classList.remove('sj-game-over-hidden');
            if (score > highScore) {
                highScore = score;
                localStorage.setItem('superJumperHighScore', highScore);
                highScoreEl.innerText = highScore;
            }
            return;
        }

        if (keys.right.pressed) {
            player.velocity.x = player.speed;
        } else if (keys.left.pressed) {
            player.velocity.x = -player.speed;
        } else {
            player.velocity.x = 0;
        }

        platforms.forEach(platform => {
            platform.draw();
            if (player.velocity.y > 0 &&
                player.position.y + player.height <= platform.position.y &&
                player.position.y + player.height + player.velocity.y >= platform.position.y &&
                player.position.x + player.width >= platform.position.x &&
                player.position.x <= platform.position.x + platform.width) {
                player.velocity.y = platform.type === 'tube' ? -player.jumpForce * 1.5 : -player.jumpForce;
            }
        });

        if (player.position.y < 100 && player.velocity.y < 0) {
            let scrollDistance = -player.velocity.y;
            score += Math.ceil(scrollDistance);
            scoreEl.innerText = score;
            platforms.forEach(platform => {
                platform.position.y += scrollDistance;
                if (platform.position.y > canvas.height) {
                    platform.position.y = -platform.height;
                    platform.position.x = Math.random() * (canvas.width - 100);
                    platform.type = Math.random() > 0.9 ? 'tube' : 'normal';
                }
            });
        }

        if (player.position.y > canvas.height) {
            gameover = true;
            gameOverScreen.classList.remove('sj-game-over-hidden');
            if (score > highScore) {
                highScore = score;
                localStorage.setItem('superJumperHighScore', highScore);
                highScoreEl.innerText = highScore;
            }
        }
    }

    // --- Event Listeners ---
    window.addEventListener('keydown', ({ keyCode }) => {
        if (gameModalOverlay.classList.contains('sj-game-modal-hidden')) return;
        switch (keyCode) {
            case 65: case 37: keys.left.pressed = true; break;
            case 68: case 39: keys.right.pressed = true; break;
        }
    });

    window.addEventListener('keyup', ({ keyCode }) => {
        if (gameModalOverlay.classList.contains('sj-game-modal-hidden')) return;
        switch (keyCode) {
            case 65: case 37: keys.left.pressed = false; break;
            case 68: case 39: keys.right.pressed = false; break;
        }
    });

    const isTouchDevice = () => 'ontouchstart' in window || navigator.maxTouchPoints > 0;
    if (isTouchDevice()) {
        touchControls.style.display = 'flex';
    }

    const leftBtn = document.getElementById('sj-game-leftBtn');
    const rightBtn = document.getElementById('sj-game-rightBtn');

    leftBtn.addEventListener('touchstart', (e) => { e.preventDefault(); keys.left.pressed = true; });
    leftBtn.addEventListener('touchend', (e) => { e.preventDefault(); keys.left.pressed = false; });
    rightBtn.addEventListener('touchstart', (e) => { e.preventDefault(); keys.right.pressed = true; });
    rightBtn.addEventListener('touchend', (e) => { e.preventDefault(); keys.right.pressed = false; });

    window.addEventListener('resize', resizeCanvas);

    // --- Start Everything ---
    startToastTimer();
});

