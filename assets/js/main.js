document.addEventListener("DOMContentLoaded", function() {
    "use strict";

    let crocoUpgradeContainer = document.querySelector(".croco-upgrade-container");
    let crocoUpgradePopup = document.querySelector(".croco-upgrade-popup");

    if (crocoUpgradeContainer && crocoUpgradePopup) {
        function addClassAfterDelay() {
            crocoUpgradePopup.classList.add('show');
        }

        setTimeout(addClassAfterDelay, 2000);
    }
});