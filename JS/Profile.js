function submitForm(event) {
    event.preventDefault(); // Prevent the default form submission

    const form = document.getElementById('profileForm');
    const formData = new FormData(form);

    // Perform client-side validation (example: ensure name and email are provided)
    const name = formData.get('name');
    const email = formData.get('email');
    if (!name || !email) {
        alert('Please provide both name and email!');
        return;
    }

    // AJAX request to save data and fetch updated profile details
    fetch('Profile-insert.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok: ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        // Check if there was an error in the response
        if (data.error) {
            throw new Error(data.error);
        }

        // Handle success: Display profile details
        const profileDetails = `
            <h4>Profile Details:</h4>
            <p>Name: ${data.name}</p>
            <p>Email: ${data.email}</p>
            <p>National ID: ${data.nationalid}</p>
            <p>Address Line 1: ${data.addressline1}</p>
            <p>Address Line 2: ${data.addressline2}</p>
            <p>City: ${data.city}</p>
            <p>Phone: ${data.phone}</p>
            <p>Postal Code: ${data.postalcode}</p>
        `;
        document.getElementById('profile-details').innerHTML = profileDetails;

        // Optionally, show a success message
        alert('Profile saved successfully!');
    })
    .catch(error => {
        // Handle errors
        console.error('Error:', error);
        alert('There was an error saving your profile: ' + error.message);
    });
}
