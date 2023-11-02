<script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
<script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/compiled/js/app.js') }}"></script>
<script src="{{ asset('assets/extensions/toastify-js/src/toastify.js') }}"></script>
<script>
    window.addEventListener('toastify', event => {
        Toastify({
            text: event.detail.text,
            duration: event.detail.text,
            close: event.detail.close,
            gravity: event.detail.gravity,
            position: event.detail.position,
            backgroundColor: event.detail.color,
        }).showToast();
    });
</script>
