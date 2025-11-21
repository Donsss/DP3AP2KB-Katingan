import './bootstrap';

import 'bootstrap/dist/js/bootstrap.bundle.min.js';

import Alpine from 'alpinejs';

import * as FilePond from 'filepond';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFilePoster from 'filepond-plugin-file-poster';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';

import GLightbox from 'glightbox';

const photoLightbox = GLightbox({
                selector: '.gallery-lightbox',
                touchNavigation: true,
                loop: true,
                closeEffect: 'fade'
            });

window.Alpine = Alpine;

FilePond.registerPlugin(
  FilePondPluginImagePreview,
  FilePondPluginFilePoster,
  FilePondPluginFileValidateSize,
  FilePondPluginFileValidateType
);

window.FilePond = FilePond;

Alpine.start();
