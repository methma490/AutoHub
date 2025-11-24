function validateForm(event) {

    // Prevent the form from submitting
    event.preventDefault();

    // get all error masages in unic varibles 
    const errorMessageDiv1 = document.getElementById("error-message1");
    const errorMessageDiv2 = document.getElementById("error-message2");
    const errorMessageDiv3 = document.getElementById("error-message3");
    const errorMessageDiv4 = document.getElementById("error-message4");

    errorMessageDiv1.textContent = ""; // Clear previous error messages
    errorMessageDiv2.textContent = ""; // Clear previous error messages
    errorMessageDiv3.textContent = ""; // Clear previous error messages
    errorMessageDiv4.textContent = ""; // Clear previous error messages

    let isValid = true;

    // check, if user enter valid name type
    const nameInput = document.getElementById("name");
    if (nameInput.value.trim() === "") {
        errorMessageDiv1.textContent += "Please enter your full name. "; // if user not enter name, the error massage will be print 
        isValid = false;
    }

    
    // check, if user enter valid Email type
    const emailInput = document.getElementById("email");
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Basic email format
    if (!emailPattern.test(emailInput.value)) {
        errorMessageDiv2.textContent += "Please enter a valid email address. "; // if user enter incorrect email, then error massage will be print 
        isValid = false;
    }


    // check if user enter valid Pasword type it must be ,
    /* 1. one or more capital leter
       2. one or more simple letter
       3. one or more special character
       4. least 8 charachters */
    const paswordInput = document.getElementById("password");
    const paswordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/ ;
    if (!paswordPattern.test(paswordInput.value)) {
        errorMessageDiv3.textContent += "Password must be at least 8 characters, contain one uppercase letter, and one symbol !"; // if user enter incorrect Pasword, then error massage will be print
        isValid = false;
    }


    // check if user enter again previous paswowrd 
    const confirmpaswordInput = document.getElementById("confirm_password");
    if (paswordInput.value !== confirmpaswordInput.value) {
        errorMessageDiv4.textContent += "Passwords do not match!"; // if user enter different pasword, then erroer massage will be print 
        isValid = false;
    }
  

    // if user enter,all of the valid input then submit the form 
    if (isValid) {
    
        document.querySelector("form").submit();
        //window.location.href="login.html" ;    
    }

    
}
