var modals = document.querySelectorAll(".modal");
var modalButtons = document.querySelectorAll(".view-recipe");
var modalContainer = document.querySelector(".modal-container");

modalButtons.forEach(function (button, index) {
    button.addEventListener("click", function () {
        modalContainer.style.display = "flex";
        modals[index].style.display = "block";
    });
});

var closeButtons = document.querySelectorAll(".close");
closeButtons.forEach(function (closeButton) {
    closeButton.addEventListener("click", function () {
        closeButton.closest(".modal").style.display = "none";
        modalContainer.style.display = "none"; 
    });
});

window.addEventListener("click", function (event) {
    if (event.target == modalContainer) {
        modals.forEach(function (modal) {
            modal.style.display = "none";
        });
        modalContainer.style.display = "none"; 
    }
});