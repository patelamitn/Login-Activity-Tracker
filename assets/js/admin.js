
document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.querySelector('#lat-toggle');
    const extraOptions = document.querySelector('#lat-extra-options');
    if (toggle && extraOptions) {
        toggle.addEventListener('change', function () {
            extraOptions.style.display = this.checked ? 'block' : 'none';
        });
    }
});
