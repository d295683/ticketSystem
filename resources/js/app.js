import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import jQuery from 'jquery';
window.$ = jQuery;

document.addEventListener('DOMContentLoaded', function() {
    const selectElement = document.getElementById('roles');
    selectElement.addEventListener('change', function() {
            Array.from(this.options).forEach(option => {
                if (!option.selected) {
                    option.disabled = true;
                }
            });
    });
});
