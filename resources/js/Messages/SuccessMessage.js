document.addEventListener("DOMContentLoaded", function () {
    const errorBox = document.getElementById("success-message");

    if (errorBox) {
        errorBox.addEventListener("click", function () {
            // Fade out effect (similar to jQuery .fadeOut(400))
            errorBox.style.transition = "opacity 0.4s ease";
            errorBox.style.opacity = "0";

            // After transition, hide the element
            setTimeout(() => {
                errorBox.style.display = "none";
            }, 400);

            console.log("error");
        });
    }
});
