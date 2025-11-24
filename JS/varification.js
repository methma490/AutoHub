

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('seller-verification-form');

    // Restrict input to numbers for Phone Number and Postal Code
    const numericFields = ['phone-number', 'postal-code'];

    numericFields.forEach(fieldId => {
        const field = document.getElementById(fieldId);

        // Allow only digits in keypress
        field.addEventListener('keypress', (e) => {
            const char = String.fromCharCode(e.which);
            if (!/[0-9]/.test(char)) {
                e.preventDefault();
            }
        });

        // Prevent pasting non-numeric content
        field.addEventListener('paste', (e) => {
            const pasteData = e.clipboardData.getData('text');
            if (!/^\d+$/.test(pasteData)) {
                e.preventDefault();
            }
        });
    });

    // Form submission
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default submission

        // Clear previous error messages
        const errorMessages = form.querySelectorAll('.error-message');
        errorMessages.forEach(error => {
            error.textContent = '';
            error.style.display = 'none';
        });

        let isValid = true;

        // Validate Full Name
        const fullName = document.getElementById('full-name');
        if (fullName.value.trim() === '') {
            showError(fullName, 'Full Name is required.');
            isValid = false;
        }

        // Validate Email
        const email = document.getElementById('email');
        if (email.value.trim() === '') {
            showError(email, 'Email Address is required.');
            isValid = false;
        } else if (!validateEmail(email.value.trim())) {
            showError(email, 'Please enter a valid email address.');
            isValid = false;
        }

        // Validate Phone Number
        const phone = document.getElementById('phone-number');
        if (phone.value.trim() === '') {
            showError(phone, 'Phone Number is required.');
            isValid = false;
        }

        // Validate Postal Code
        const postalCode = document.getElementById('postal-code');
        if (postalCode.value.trim() === '') {
            showError(postalCode, 'Postal Code is required.');
            isValid = false;
        }

        // Validate NIC Uploads
        const frontNIC = document.getElementById('front-side');
        const rearNIC = document.getElementById('rear-side');

        if (frontNIC.files.length === 0) {
            showError(frontNIC, 'Please upload the front side of your NIC.');
            isValid = false;
        }

        if (rearNIC.files.length === 0) {
            showError(rearNIC, 'Please upload the rear side of your NIC.');
            isValid = false;
        }

        //  District
        const district = document.getElementById('district');
        if (district.value === '') {
            showError(district, 'Please select your district.');
            isValid = false;
        }

        //  City
        const city = document.getElementById('city');
        if (city.value.trim() === '') {
            showError(city, 'City is required.');
            isValid = false;
        }

        //Terms and Conditions
        const terms = document.getElementById('terms');
        if (!terms.checked) {
            showError(terms, 'You must accept the terms and conditions.');
            isValid = false;
        }

        // If all validations pass
        if (isValid) {
            alert('Form submitted successfully!');
            form.reset(); // Reset the form
        }
    });

    // Function to display error messages
    function showError(inputElement, message) {
        const error = inputElement.parentElement.querySelector('.error-message');
        if (error) {
            error.textContent = message;
            error.style.display = 'block';
        }
    }

    //validate email using regex
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email.toLowerCase());
    }
});
