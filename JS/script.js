document.getElementById('feedbackForm').addEventListener('submit', function(event) {

    event.preventDefault();

    let name = document.getElementById('name').value.trim();
    let email = document.getElementById('email').value.trim();
    let rating = document.querySelector('input[name="rating"]:checked');
    let messageDiv = document.getElementById('form-message');


    if (name === '' || email === '' || !rating) {
        messageDiv.textContent = 'Please fill out all required fields (Name, Email, Rating).';
        messageDiv.className = 'error';
        return;
    }

  
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        messageDiv.textContent = 'Please enter a valid email address.';
        messageDiv.className = 'error';
        return;
    }

   
    messageDiv.textContent = '';
    messageDiv.className = '';
    this.submit();
});