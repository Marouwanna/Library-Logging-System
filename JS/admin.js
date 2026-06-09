document.getElementById('admin-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value;
    const messageEl = document.getElementById('admin-message');
    
    if (username.length < 3) {
        messageEl.textContent = 'Username must be at least 3 characters';
        messageEl.style.color = 'red';
        return;
    }
    
    if (password.length < 6) {
        messageEl.textContent = 'Password must be at least 6 characters';
        messageEl.style.color = 'red';
        return;
    }
    
    messageEl.textContent = 'Logging in...';
    messageEl.style.color = 'blue';
    
    fetch(this.action, {
        method: 'POST',
        body: new FormData(this)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            messageEl.textContent = 'Login successful! Redirecting...';
            messageEl.style.color = 'green';
            setTimeout(() => {
                window.location.href = data.redirect;
            }, 1000);
        } else {
            messageEl.textContent = data.message;
            messageEl.style.color = 'red';
        }
    })
    .catch(error => {
        messageEl.textContent = 'An error occurred. Please try again.';
        messageEl.style.color = 'red';
        console.error('Error:', error);
    });
});