
document.addEventListener('DOMContentLoaded', () => {
    // Click hamburger menu
    let $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.hamburger'), 0);
    if ($navbarBurgers.length > 0) {

        // Add a click event on each of them
        $navbarBurgers.forEach( $el => {
            $el.addEventListener('click', function() {

                // Add class
                this.classList.toggle("is-active");

                // Get the "main-nav" element
                let $target = document.getElementById('main-nav');

                // Toggle the class on "main-nav"
                $target.classList.toggle('hidden');

            });
        });
    }
});
