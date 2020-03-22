
// Axios
import Axios from 'axios';

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

function updateList(data) {

    let $target = document.querySelector('[data-result-autocomplete] ul');

    let listHtml = [];

    // Fill dom
    let $list = Array.prototype.slice.call(data, 0);
    let n = 0;
    $list.forEach(($el) => {
        if (n<10) {
            listHtml.push('<li data-plain-txt="' + $el.first_name + '" class="p-3 ' + (n == 0 ? ' border-b bg-gray-200 active' : '')+ '">' + $el.first_name + '</li>');
        }
        n++;
    });
    $target.innerHTML = listHtml.join(' ');

    // Hide  data-placeholder-autocomplete
    document.querySelector('[data-placeholder-autocomplete]').classList.add('hidden');

}

function setSelectedList(keyCode, field) {
    // TODO
    console.log('arrow UP/Down');
    let children = document.querySelector('[data-result-autocomplete] ul').children;

    let $list = Array.prototype.slice.call(children, 0);
    let currIndex = 0;
    for(let i = 0; i<$list.length; i++) {
        let $el = $list[i];
        if ($el.className.includes('active')) {
            currIndex = i;
        }
    }

    let stepIndex = keyCode == 40 ? currIndex + 1 : currIndex - 1;

    if (stepIndex==$list.length) {
        stepIndex = 0;
    }
    /*console.log('keyCode',keyCode);
    console.log('currIndex',currIndex);
    console.log('$list.length',$list.length);
    console.log('stepIndex',stepIndex);*/



    for(let i = 0; i<$list.length; i++) {
        let $el = $list[i];
        $el.classList.remove('border-b');
        $el.classList.remove('bg-gray-200');
        $el.classList.remove('active');
        if (stepIndex == i) {
            $el.classList.add('border-b');
            $el.classList.add('bg-gray-200');
            $el.classList.add('active');
            field.value = $el.textContent;

        }
    }


}

document.addEventListener('DOMContentLoaded', () => {
    // Click more search - show filter
    let $searchMore = Array.prototype.slice.call(document.querySelectorAll('[data-search-more]'), 0);
    if ($searchMore.length > 0) {

        // Add a click event on each of them
        $searchMore.forEach( ($el) => {

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

        // Add a click event on each of them
        $searchField.forEach( ($el) => {

            $el.addEventListener('keyup', event =>  {
                if ($el.value.trim().length >= 1 && (event.keyCode === 40 || event.keyCode === 38)) {
                    setSelectedList(event.keyCode, $el);
                }
            });

            $el.addEventListener('keyup', (event) =>  {

                if ( (event.keyCode === 40 || event.keyCode === 38)) {
                    return;
                }


                // hide filter autocomplete if textfield has <= 1 char
                document.querySelector('[data-filter-autocomplete]').classList.add('hidden');

                if ($el.value.trim().length >= 1) {

                    // show filter autocomplete
                    document.querySelector('[data-filter-autocomplete]').classList.remove('hidden');

                    // Show placeholder
                    document.querySelector('[data-placeholder-autocomplete]').classList.remove('hidden');
                    document.querySelector('[data-placeholder-autocomplete]').textContent = `Recherche de ${$el.value}...`;

                    // TODO call ajax and fill dom
                    Axios.get('https://www.balldontlie.io/api/v1/players')
                        .then(function (response) {
                            updateList(response.data.data);
                        });
                }

            });
        });
    }
});
