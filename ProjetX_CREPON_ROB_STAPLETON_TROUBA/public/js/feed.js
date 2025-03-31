document.addEventListener("DOMContentLoaded", function() {
    let textarea = document.getElementById("input_post");

    function updatePlaceholder() {
        if (textarea.value.trim() === "What's happening?") {
            textarea.classList.add("placeholder-active");
        } else {
            textarea.classList.remove("placeholder-active");
        }
    }

    textarea.addEventListener("focus", function() {
        if (textarea.value.trim() === "What's happening?") {
            textarea.value = "";
            textarea.classList.remove("placeholder-active");
        }
    });

    textarea.addEventListener("blur", function() {
        if (textarea.value.trim() === "") {
            textarea.value = "What's happening?";
            textarea.classList.add("placeholder-active");
        }
    });

    function autoResize() {
        textarea.style.height = "auto"; 
        textarea.style.height = Math.max(textarea.scrollHeight, 20) + "px"; 
    }

    textarea.addEventListener("input", autoResize);

    if (textarea.value.trim() !== "") {
        autoResize();
    }

    updatePlaceholder();
});