import "./bootstrap";

import Alpine from "alpinejs";
import focus from "@alpinejs/focus";
window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();

const linebar1 = document.querySelector(".line-bar-1");
const linebar2 = document.querySelector(".line-bar-2");
const containeroptions = document.querySelector(".container-options");

if (linebar1 && linebar2 && containeroptions) {
    document.querySelector(".bar-menu").addEventListener("click", () => {
        linebar1.classList.toggle("activemenuline-bar-1");
        linebar2.classList.toggle("activemenuline-bar-2");
        containeroptions.classList.toggle("activecontainer-options");
    });
}

const accordians = document.querySelectorAll(".accordian-animation");
if (accordians) {
    accordians.forEach((accordian) => {
        accordian.addEventListener("click", (event) => {
            const icon = event.currentTarget.querySelector(".icon-accordian");
            if (icon.style.transform === "rotate(180deg)") {
                icon.style.removeProperty("transform");
            } else {
                icon.style.transform = "rotate(180deg)";
            }
        });
    });
}
