import './bootstrap';
import '@fortawesome/fontawesome-free/css/all.css';

import Alpine from 'alpinejs';

import 'bs-custom-file-input';
$(document).ready(function () {
  bsCustomFileInput.init();
});

window.Alpine = Alpine;

Alpine.start();
