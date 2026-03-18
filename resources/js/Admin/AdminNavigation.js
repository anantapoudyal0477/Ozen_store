// document.addEventListener("DOMContentLoaded", () => {
//     const toggleBtn = document.getElementById("sidebar-toggle");
//     const sidebar = document.getElementById("admin-sidebar");
//     const overlay = document.getElementById("overlay");
//     const toggleDiv = document.getElementById("mobile-toggle"); // the div containing the button

//     // Mobile sidebar toggle
//     if (toggleBtn && sidebar && overlay && toggleDiv) {
//         toggleBtn.addEventListener("click", () => {
//             sidebar.classList.toggle("-translate-x-full");
//             overlay.classList.toggle("hidden");

//             // Hide the toggle button when sidebar is visible
//             if (!sidebar.classList.contains("-translate-x-full")) {
//                 toggleDiv.classList.add("hidden");
//             } else {
//                 toggleDiv.classList.remove("hidden");
//             }
//         });

//         overlay.addEventListener("click", () => {
//             sidebar.classList.add("-translate-x-full");
//             overlay.classList.add("hidden");

//             // Show the toggle button when sidebar is closed
//             toggleDiv.classList.remove("hidden");
//         });
//     }

//     // Submenu collapse
//     const submenus = document.querySelectorAll(".submenu");
//     const toggles = document.querySelectorAll(".category-toggle");

//     toggles.forEach(btn => {
//         btn.addEventListener("click", () => {
//             const submenu = btn.nextElementSibling;
//             const arrow = btn.querySelector(".arrow");

//             if (submenu) {
//                 submenu.classList.toggle("hidden"); // toggle visibility
//                 arrow.textContent = arrow.textContent === "▾" ? "▸" : "▾";
//             }
//         });
//     });
// });
