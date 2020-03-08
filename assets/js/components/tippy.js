// popper - tippy
import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css';
import 'tippy.js/animations/scale.css'

document.addEventListener('DOMContentLoaded', () => {
    // Trigger tooltip
    tippy('[data-tippy-content]');
});
