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

document.querySelectorAll(".quote").forEach(div => {
    div.addEventListener("click", (event) => {
        const bk = document.querySelector("#background_popup");
        if (bk) {
            bk.style.display = "flex";
            event.stopPropagation();
        }
    });
});

document.addEventListener("click", (event) => {
    const popup = document.querySelector("#background_popup");
    if (popup && !popup.contains(event.target)) {
        popup.style.display = "none";
    }
});

document.querySelectorAll("#background_popup").forEach(div => {
    div.addEventListener("click", (event) => {
        if (event.target === div) {
            div.style.display = "none";
        }
    });
});