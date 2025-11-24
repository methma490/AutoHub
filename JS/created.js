// Store selected files in an array
let selectedFiles = [];

// Function to preview selected photos
function previewPhoto(slotNumber) {
    const input = document.getElementById(`photo${slotNumber}`);
    const slot = document.getElementById(`slot${slotNumber}`);

    if (input.files && input.files[0]) {
        const file = input.files[0];

        // Check if the file has already been selected
        if (selectedFiles.includes(file.name)) {
            alert("You cannot select the same photo again.");
            input.value = ""; // Clear the file input
            return;
        }

        // Add the selected file name to the array
        selectedFiles.push(file.name);

        const reader = new FileReader();
        reader.onload = function(e) {
            slot.style.backgroundImage = `url(${e.target.result})`;
            slot.style.backgroundSize = "cover";
            slot.style.backgroundPosition = "center";
        };
        reader.readAsDataURL(file);
    }
}

// Listen for changes on all photo input elements
document.addEventListener("DOMContentLoaded", function() {
    for (let i = 1; i <= 5; i++) {
        const input = document.getElementById(`photo${i}`);
        if (input) {
            input.addEventListener('change', function() {
                // Resetting the photo slot when the input is cleared
                if (!input.files.length) {
                    selectedFiles = selectedFiles.filter(file => file !== input.files[0]?.name);
                    const slot = document.getElementById(`slot${i}`);
                    slot.style.backgroundImage = ''; // Reset the background image
                }
            });
        }
    }
});
