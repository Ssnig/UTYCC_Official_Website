// Wrapping the code in a self-executing anonymous function to avoid global scope pollution.
(function() {
    // A helper function to easily select elements
    const $ = (sel, root = document) => root.querySelector(sel);

    // Get references to all the important DOM elements
    const heading = $('#auth-heading');
    const sub = $('#auth-sub');
    const viewLogin = $('#view-login');
    const viewSignup = $('#view-signup');
    const toSignup = $('#to-signup');
    const toLogin = $('#to-login');
    const loginForm = $('#login-form');
    const signupForm = $('#signup-form');
    const toastWrap = $('.toast-wrap');

    // Function to switch between login and signup views
    function setView(mode) {
        const isLogin = mode === 'login';
        viewLogin.classList.toggle('active', isLogin);
        viewSignup.classList.toggle('active', !isLogin);
        viewSignup.setAttribute('aria-hidden', String(isLogin));
        heading.textContent = isLogin ? 'Sign in' : 'Create your account';
        sub.textContent = isLogin ? 'to continue to UTYCC' : 'Join our community!';
    }

    // Event listeners to toggle the view when links are clicked
    toSignup.addEventListener('click', (e) => {
        e.preventDefault();
        setView('signup');
    });
    toLogin.addEventListener('click', (e) => {
        e.preventDefault();
        setView('login');
    });

    // Function to create and display a toast message
    function showToast(message, type = 'success', duration = 4000) {
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.innerHTML = `<span>${message}</span><button class="close-btn" aria-label="Close">×</button>`;
        const closer = toast.querySelector('.close-btn');
        const removeToast = () => toast.remove();
        closer.addEventListener('click', removeToast);
        toastWrap.appendChild(toast);
        // Automatically remove the toast after a certain duration
        setTimeout(removeToast, duration);
    }

    // Validation helper function for email format
    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    // Login form submission handler
    loginForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const email = $('#login-email', loginForm).value.trim();
        const password = $('#login-password', loginForm).value;

        if (!isValidEmail(email)) {
            showToast('Please enter a valid email address.', 'error');
            return;
        }
        if (!password || password.length < 6) {
            showToast('Password must be at least 6 characters long.', 'error');
            return;
        }
        // In a real application, you would send this data to a server for authentication.
        // For this example, we just show a success message.
        showToast('Sign in successful. Welcome back!', 'success');
    });

    // Signup form submission handler
    signupForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const name = $('#signup-name', signupForm).value.trim();
        const email = $('#signup-email', signupForm).value.trim();
        const password = $('#signup-password', signupForm).value;
        const confirmPassword = $('#signup-confirm', signupForm).value;
        const termsAccepted = $('#term').checked;

        if (!name) {
            showToast('Please enter your full name.', 'error');
            return;
        }
        if (!isValidEmail(email)) {
            showToast('Please enter a valid email address.', 'error');
            return;
        }
        if (!password || password.length < 8) {
            showToast('Password must be at least 8 characters.', 'error');
            return;
        }
        if (password !== confirmPassword) {
            showToast('Passwords do not match.', 'error');
            return;
        }
        if (!termsAccepted) {
            showToast('You must agree to the terms and privacy policy.', 'error');
            return;
        }
        // In a real application, you would send this data to a server to create the account.
        // For this example, we just show a success message and switch back to the login view.
        showToast('Account created successfully! Please sign in.', 'success');
        setView('login');
    });
})();
