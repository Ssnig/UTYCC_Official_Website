document.getElementById('feedbackForm').addEventListener('submit', function(event) {
    // Prevent the default form submission
    event.preventDefault();

    let name = document.getElementById('name').value.trim();
    let email = document.getElementById('email').value.trim();
    let rating = document.querySelector('input[name="rating"]:checked');
    let messageDiv = document.getElementById('form-message');

    // Basic validation
    if (name === '' || email === '' || !rating) {
        messageDiv.textContent = 'Please fill out all required fields (Name, Email, Rating).';
        messageDiv.className = 'error';
        return;
    }

    // Email format validation
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        messageDiv.textContent = 'Please enter a valid email address.';
        messageDiv.className = 'error';
        return;
    }

    // If validation passes, submit the form
    messageDiv.textContent = '';
    messageDiv.className = '';
    this.submit();
});