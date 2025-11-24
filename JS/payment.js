//--------------------------pyment page functions-------------------------------
function correctData(event) {
    // Prevent the form from submitting
    event.preventDefault();
    
    

    // get all error masages in unic varibles 
    const error_Msg_Div1 = document.getElementById("error-msg1");
    const error_Msg_Div2 = document.getElementById("error-msg2");
    const error_Msg_Div3 = document.getElementById("error-msg3");
    const error_Msg_Div4 = document.getElementById("error-msg4");
    const error_Msg_Div5 = document.getElementById("error-msg5");
    const error_Msg_Div6 = document.getElementById("error-msg6");
    const error_Msg_Div7 = document.getElementById("error-msg7");
    const error_Msg_Div8 = document.getElementById("error-msg8");
    const error_Msg_Div9 = document.getElementById("error-msg9");
    const error_Msg_Div10 = document.getElementById("error-msg10");
    const error_Msg_Div11 = document.getElementById("error-msg11");
    const error_Msg_Div12 = document.getElementById("error-msg12");

    // Clear previous error messages
    error_Msg_Div1.textContent = "";
    error_Msg_Div2.textContent = "";
    error_Msg_Div3.textContent = "";
    error_Msg_Div4.textContent = "";
    error_Msg_Div5.textContent = "";
    error_Msg_Div6.textContent = "";
    error_Msg_Div7.textContent = "";
    error_Msg_Div8.textContent = "";
    error_Msg_Div9.textContent = "";
    error_Msg_Div10.textContent = "";
    error_Msg_Div11.textContent = "";
    error_Msg_Div12.textContent = "";

    let isValid = true;

    //------------Billing Address Part-------------

    // Validate Full Name
    const nameInput1 = document.getElementById("name");
    if (nameInput1.value.trim() === "") {
        error_Msg_Div1.textContent += "Please enter your full name.";
        isValid = false;
    }


    // valid Email 
    const emailInput = document.getElementById("email") ;
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Basic email format
    if (!emailPattern.test(emailInput.value)) {
        error_Msg_Div2.textContent += "Please enter a valid email address. ";
        isValid = false;
    }

    // Validate  Address
    const AddressInput = document.getElementById("address");
    if (AddressInput.value.trim() === "") {
        error_Msg_Div3.textContent += "Please enter Address.";
        isValid = false;
    }


    // Validate city
     const cityInput = document.getElementById("city");
     if (cityInput.value.trim() === "") {
         error_Msg_Div4.textContent += "Please enter City.";
         isValid = false;
    }


    // Validate city
    const stateInput = document.getElementById("state");
    if (stateInput.value.trim() === "") {
        error_Msg_Div5.textContent += "Please enter State.";
        isValid = false;
    }


    // valid zip code
    const ZipcodeInput = document.getElementById("zip");
    const ZipcodePattern = /^[0-9]{5,6}$/;
    if (!ZipcodePattern.test(ZipcodeInput.value)){
        error_Msg_Div6.textContent += "Please enter Zip code.";
        isValid = false;
    }


    // -----------Billing payment Part--------------


    // Validate Card Name
    const cardNameInput = document.getElementById("cardName");
    if (cardNameInput.value.trim() === "") {
        error_Msg_Div7.textContent += "Please enter your Card Name.";
        isValid = false;
    }

    // valid card number 
    const cardnumber = document.getElementById("cardNum");
    const cardPattern = /^[0-9]{15,16}$/ ; 
    if(!cardPattern.test(cardnumber.value)){
        error_Msg_Div8.textContent += "Please enter your Card Number.";
        isValid = false ; 
    }


    // valid zip code
    const CvvInput = document.getElementById("cvv");
    const CvvPattern = /^[0-9]{4,5}$/;
    if (!CvvPattern.test(CvvInput.value)){
        error_Msg_Div9.textContent += "Please enter CVV.";
        isValid = false;
    }

    
    // valid month
    const expMonth = document.getElementById("expmonth");
    if(expMonth.value === ""){
        error_Msg_Div10.textContent += "Please enter your Card Expire Month.";
        isValid = false ;
    }


    // valid month
    const expYear = document.getElementById("expYear");
    if(expYear.value === ""){
        error_Msg_Div11.textContent += "Please enter your Card Expire Year.";
        isValid = false ;
    }

    // valid amount 
    const amount = document.getElementById("amount");
    if(amount.value === ""){
        error_Msg_Div12.textContent += "Please enter your Amount.";
        isValid = false ;
    }



    // if user enter correct data, submit the form
    if (isValid) {
       
        document.querySelector("form").submit();
        //window.location.href="payment.succesfull.php"

    }
    

}

// ----------------------------payment succesfull page functions----------------------
 
// function to go ads page 
function done_btn(){

    window.location.href  = "AdsPgread.php" ;  
}

// function to the payment succesfull recipt
function download_btn(){

    const element = document.getElementById("invoice") ; 

    html2pdf()
    .from(element)
    .save()
    
    
    window.location.href="#";
}


