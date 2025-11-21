import * as bootstrap from 'bootstrap/dist/js/bootstrap.bundle.min.js';

import $ from 'jquery';
window.$ = $;
window.jQuery = $;

import GLightbox from 'glightbox';

import TomSelect from 'tom-select';

window.bootstrap = bootstrap;
window.GLightbox = GLightbox;
window.TomSelect = TomSelect;

const photoLightbox = GLightbox({
            selector: '.gallery-lightbox',
            touchNavigation: true,
            loop: true,
            closeEffect: 'fade',
        });
