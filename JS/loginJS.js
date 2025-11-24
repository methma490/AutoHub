// JavaScript for form validation
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    
    form.addEventListener("submit", function (event) {
        event.preventDefault();  // Prevent form submission
        
        const username = form.querySelector("input[type='text']").value;
        const password = form.querySelector("input[type='password']").value;
        
        if (username === "") {
            alert("Username cannot be empty!");
        } else if (password === "") {
            alert("Password cannot be empty!");
        } 
    });
});

// JavaScript for form validation and inline error handling
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    
    form.addEventListener("submit", function (event) {
        event.preventDefault();  // Prevent form submission
        
        const username = form.querySelector("input[type='text']");
        const password = form.querySelector("input[type='password']");
        let isValid = true;

        // Clear any previous error messages
        clearError(username);
        clearError(password);

        // Validate username
        if (username.value === "") {
            showError(username, "Username cannot be empty!");
            isValid = false;
        }

        // Validate password
        if (password.value === "") {
            showError(password, "Password cannot be empty!");
            isValid = false;
        }

        // If form is valid, show success message and reset the form
       if (isValid) {
            alert("Form submitted successfully!");
            //form.reset();  // Clears all input fields after submission
            document.querySelector("form").submit();
        }
    });

    // Function to show error message
    function showError(input, message) {
        const errorDiv = document.createElement("div");
        errorDiv.className = "error-message";
        errorDiv.textContent = message;
        input.parentElement.appendChild(errorDiv);
    }

    // Function to clear error message
    function clearError(input) {
        const errorDiv = input.parentElement.querySelector(".error-message");
        if (errorDiv) {
            errorDiv.remove();
        }
    }
});
