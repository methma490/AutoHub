/*Ads Page Javascript*/
// Function to filter ads by category and location
function filterAds() {
    var selectedCategory = document.getElementById('category').value;
    var selectedLocation = document.getElementById('location').value;
    var adBoxes = document.getElementsByClassName('ad-box');

    var matchFound = false;

    // Loop through all ad boxes and display only the ones that match the selected category and location
    for (var i = 0; i < adBoxes.length; i++) {
        var adBox = adBoxes[i];
        var images = adBox.getElementsByTagName('img');
        
        if (images.length > 0) {
            var firstImage = images[0];
            var adLocation = firstImage.getAttribute('data-location');
            var adCategory = adBox.id;

            if (adCategory === selectedCategory && adLocation === selectedLocation) {
                adBox.style.display = 'block'; // Show ads that match both category and location
                matchFound = true; // Mark that a match is found
            } else {
                adBox.style.display = 'none'; // Hide other ads
            }
        }
    }

    //Show alert if no match is found
    if (!matchFound) {
        alert("No ads found for the selected category and location.");
    }
}

// Function to show ad details in a modal
function showDetails(adBox) {
    const images = adBox.getElementsByTagName('img');
    
    if (images.length > 0) {
        const firstImage = images[0];
        document.getElementById('adCondition').innerText = firstImage.getAttribute('data-condition');
        document.getElementById('adPrice').innerText = firstImage.getAttribute('data-price');
        document.getElementById('adPhone').innerText = firstImage.getAttribute('data-phone');
        document.getElementById('adLocation').innerText = firstImage.getAttribute('data-location');
        document.getElementById('adDescription').innerText = firstImage.getAttribute('data-description');
    }
    
    var modal = document.getElementById('detailsModal');
    modal.style.display = 'block';
}

// Function to close modal
function closeDetails() {
    var modal = document.getElementById('detailsModal');
    modal.style.display = 'none';
}
