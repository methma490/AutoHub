/*About Us Page javascript*/

document.addEventListener("DOMContentLoaded", () => {
    const learnMoreButton = document.getElementById("learnMoreButton");
    const modal = document.getElementById("learnMoreModal");
    const closeModalButton = document.getElementsByClassName("close")[0];

    // Show the modal when the Learn More button is clicked
    learnMoreButton.addEventListener("click", () => {
        modal.style.display = "block";
    });

    // Close the modal when the close button is clicked
    closeModalButton.addEventListener("click", () => {
        modal.style.display = "none";
    });

    // Close the modal when clicking outside of it
    window.addEventListener("click", (event) => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});