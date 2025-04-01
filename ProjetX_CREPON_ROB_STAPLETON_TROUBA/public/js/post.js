document.querySelectorAll(".li_rt").forEach(li => {
    li.addEventListener("click", (event) => {
        const div = li.querySelector(".div_rt");
        if (div && div.classList.contains("div_rt")) {
            div.style.display = "flex";
            event.stopPropagation();
        }
    });
});

document.addEventListener("click", (event) => {
    document.querySelectorAll(".div_rt").forEach(div => {
        if (!div.contains(event.target)) {
            div.style.display = "none";
        }
    });
});