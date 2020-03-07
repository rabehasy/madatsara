var hamburgers = document.querySelectorAll(".hamburger");
if (hamburgers.length > 0) {
    hamburgers.forEach(function(hamburger) {
        hamburger.addEventListener("click", function() {
            this.classList.toggle("is-active");
        }, false);
    });
}
