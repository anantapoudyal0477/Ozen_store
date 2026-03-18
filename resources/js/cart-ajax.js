document.addEventListener("DOMContentLoaded", function () {
    const removeButtons = document.querySelectorAll(".cart-item-remove-btn");

    removeButtons.forEach(btn => {
        btn.addEventListener("click", function (e) {
            e.preventDefault();
            const id = this.dataset.id;
            console.log("Removing item with ID:", id);
            // your ajax logic here (fetch or XMLHttpRequest)
        });
    });
});
