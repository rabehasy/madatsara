
// Axios
import Axios from 'axios';

// Autocomplete
import AutoComplete from './autocomplete';

/**
 * Execute a function given a delay time
 *
 * @param {type} func
 * @param {type} wait
 * @param {type} immediate
 * @returns {Function}
 */
var debounce = (func, wait, immediate) => {
    var timeout;
    return () => {
        var context = this, args = arguments;
        var later = () => {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
};


document.addEventListener('DOMContentLoaded', () => {
    // Click more search - show filter
    let $searchMore = Array.prototype.slice.call(document.querySelectorAll('[data-search-more]'), 0);
    if ($searchMore.length > 0) {

        // Add a click event on each of them
        $searchMore.forEach( ($el) => {

            $el.addEventListener('click', function () {

                // Hide icon more
                this.classList.toggle("hidden");

                // Get the "main-nav" element
                let $target = document.querySelector('[data-filter-more]');

                // Toggle the class on "main-nav"
                $target.classList.toggle('hidden');

            });
        });
    }

    // Click outside - for example outside filter search
    document.addEventListener("click", evt => {
        const $searchMoreButtonElement = document.querySelector("[data-search-more]");
        const $searchMoreFilterElement = document.querySelector("[data-filter-more]");
        const $datepickrElement = document.querySelector(".flatpickr-calendar");
        let targetElement = evt.target; // clicked element

        do {
            if (
                targetElement == $searchMoreButtonElement ||
                $searchMoreFilterElement == targetElement ||
                $datepickrElement == targetElement
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

        new AutoComplete({
            selector: '[data-search-field]',
            minChars: 2,
            selectedClass: 'bg-gray-200',
            source: function(term, suggest){
                Axios.get('https://www.balldontlie.io/api/v1/players?q=' + encodeURIComponent(term))
                    .then(function (response) {
                        let choices = response.data.data;
                        var matches = [];
                        for (let i=0; i<choices.length; i++) {
                            matches.push(choices[i].first_name);
                        }
                        suggest(matches);
                    });
            },
            renderItem: function (item, search){
                search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
                return '<li class="autocomplete-suggestion cursor-pointer p-3 " data-val="' + item  + '"><i class="fa fa-search"></i> ' + item  + '</li>';
            }
        });

    }



});
