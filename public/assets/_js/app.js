document.addEventListener("DOMContentLoaded", () => {
    let script = document.createElement("script");
    script.src = "https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js";
    script.async = true;
    document.body.appendChild(script);

    // Mobile navigation
    const navOpener = document.querySelector(".nav-opener");
    const navCloser = document.querySelector(".nav-closer");
    const mainNav = document.getElementById("main-nav");

    if (navOpener && navCloser && mainNav) {
        navOpener.addEventListener("click", function () {
            mainNav.classList.add("active");
        });

        navCloser.addEventListener("click", function () {
            mainNav.classList.remove("active");
        });
    }

    // Filter toggle for mobile
    const filterToggle = document.getElementById("filter-toggle");
    const filterContainer = document.getElementById("filter-container");

    if (filterToggle && filterContainer) {
        filterToggle.addEventListener("click", function() {
            filterContainer.classList.toggle("show");
            // Change button text based on visibility
            if (filterContainer.classList.contains("show")) {
                filterToggle.innerHTML = '<i class="filter-icon">✕</i> Hide Filters';
            } else {
                filterToggle.innerHTML = '<i class="filter-icon">⚙️</i> Filter Games';
            }
        });
    }

    // Handle game filtering
    const gameFilterForm = document.getElementById("game-filter-form");
    const resetFiltersBtn = document.getElementById("reset-filters");

    if (gameFilterForm) {
        gameFilterForm.addEventListener("submit", function(e) {
            e.preventDefault();
            // Filter logic will be implemented here
            console.log("Filters applied");
        });
    }

    if (resetFiltersBtn) {
        resetFiltersBtn.addEventListener("click", function() {
            const inputs = gameFilterForm.querySelectorAll("input");
            const selects = gameFilterForm.querySelectorAll("select");

            // Reset all inputs
            inputs.forEach(input => {
                input.value = "";
            });

            // Reset all selects
            selects.forEach(select => {
                select.selectedIndex = 0;
            });

            console.log("Filters reset");
        });
    }
});
