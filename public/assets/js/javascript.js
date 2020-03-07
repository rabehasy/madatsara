/**
 * Execute a function given a delay time
 *
 * @param {type} func
 * @param {type} wait
 * @param {type} immediate
 * @returns {Function}
 */
var debounce = function (func, wait, immediate) {
    var timeout;
    return function() {
        var context = this, args = arguments;
        var later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
};


// Navbar Toggle
document.addEventListener('DOMContentLoaded', function () {

    // Trigger tooltip
    tippy('[data-tippy-content]');

    // Click hamburger menu
    let $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.hamburger'), 0);
    if ($navbarBurgers.length > 0) {

        // Add a click event on each of them
        $navbarBurgers.forEach(function ($el) {
            $el.addEventListener('click', function () {

                // Add class
                this.classList.toggle("is-active");

                // Get the "main-nav" element
                let $target = document.getElementById('main-nav');

                // Toggle the class on "main-nav"
                $target.classList.toggle('hidden');

            });
        });
    }

    // Click more search - show filter
    let $searchMore = Array.prototype.slice.call(document.querySelectorAll('[data-search-more]'), 0);
    if ($searchMore.length > 0) {

        // Add a click event on each of them
        $searchMore.forEach(function ($el) {

            $el.addEventListener('click', function () {

                // Hide icon more
                this.classList.toggle("hidden");

                // Hide filter autocomplete
                document.querySelector('[data-filter-autocomplete]').classList.add('hidden');

                // Get the "main-nav" element
                let $target = document.querySelector('[data-filter-more]');

                // Toggle the class on "main-nav"
                $target.classList.toggle('hidden');

            });
        });
    }

    // Click outside - for example outside filter search
    document.addEventListener("click", (evt) => {
        const $searchMoreButtonElement = document.querySelector("[data-search-more]");
        const $searchMoreFilterElement = document.querySelector("[data-filter-more]");
        let targetElement = evt.target; // clicked element

        do {
            if (
                targetElement == $searchMoreButtonElement ||
                $searchMoreFilterElement == targetElement
            ) {
                // This is a click inside. Do nothing, just return.
                return;
            }
            // Go up the DOM
            targetElement = targetElement.parentNode;
        } while (targetElement);

        // This is a click outside.
        let $target = document.querySelector('[data-filter-more]');
        // console.log('[data-filter-more] hidden? ', $target.classList.contains('hidden'));
        if (!$target.classList.contains('hidden')) {
            $target.classList.add('hidden');

            // Show icon arrow-sort-up
            $searchMoreButtonElement.classList.remove('hidden');
        }
    });

    // Search field - autocomplete
    let $searchField = Array.prototype.slice.call(document.querySelectorAll('[data-search-field]'), 0);
    if ($searchField.length > 0) {

        // Add a click event on each of them
        $searchField.forEach(function ($el) {

            $el.addEventListener('keyup', debounce(function () {

                // hide filter autocomplete if textfield has <= 1 char
                document.querySelector('[data-filter-autocomplete]').classList.add('hidden');

                if ($el.value.trim().length >= 1) {

                    // show filter autocomplete
                    document.querySelector('[data-filter-autocomplete]').classList.remove('hidden');

                    // Show placeholder
                    document.querySelector('[data-placeholder-autocomplete]').textContent = 'Recherche de ' + $el.value + '...';

                    // TODO call ajax
                }

            },100));
        });
    }

});