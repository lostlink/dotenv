require('./bootstrap');
require('./tailwindui');

document.addEventListener('alpine:init', () => {
    // Magic: $tooltip
    Alpine.magic('tooltip', (el) => (message) => {
        let instance = tippy(el, { content: message, trigger: 'manual' });

        instance.show();

        setTimeout(() => {
            instance.hide();

            setTimeout(() => instance.destroy(), 150);
        }, 2000);
    });

    // Directive: x-tooltip
    Alpine.directive('tooltip', (el, { expression }) => {
        tippy(el, {
            content: expression,
            theme: 'light-border',
        });
    });
});

Alpine.start();

ClipboardJS.on('success', function (e) {
    Swal.fire({
        position: 'top-end',
        timer: 3000,
        toast: true,
        text: null,
        showCancelButton: false,
        showConfirmButton: false,
        icon: 'success',
        title: 'Copied to Clipboard!',
    });
    e.clearSelection();
});

ClipboardJS.on('error', function (e) {
    Swal.fire({
        position: 'top-end',
        timer: 3000,
        toast: true,
        text: null,
        showCancelButton: false,
        showConfirmButton: false,
        icon: 'error',
        title: 'Error copying to the Clipboard!',
    });
});
