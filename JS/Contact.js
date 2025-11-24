document.getElementById('userForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent page reload on form submission

    // Collect form data
    const formData = new FormData(this);

    // AJAX request to send the data to PHP script
    fetch('save_user.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())  // Handle response
    .then(data => {
        document.getElementById('response').innerHTML = data; // Show server response
    })
    .catch(error => console.error('Error:', error)); // Handle error
});
