// popper - tippy
import _flatpickr from "flatpickr"
import "flatpickr/dist/themes/dark.css"
import "flatpickr/dist/flatpickr.min.css"
import { French } from "flatpickr/dist/l10n/fr.js"

document.addEventListener('DOMContentLoaded', () => {
    // datepicker
    let config = {
        dateFormat: 'd-m-Y',
        locale: French,
        wrap: true
    };
    let calendar = _flatpickr('[data-datepicker]', config);

});
