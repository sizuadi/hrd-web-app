<script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
<script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/compiled/js/app.js') }}"></script>
<script src="{{ asset('assets/extensions/toastify-js/src/toastify.js') }}"></script>
<script>
    window.addEventListener('toastify', event => {
        let data = event.detail[0];
        Toastify({
            text: data.text,
            duration: data.text,
            close: data.close,
            gravity: data.gravity,
            position: data.position,
            backgroundColor: data.color,
            avatar: data.avatar,
        }).showToast();
    });
</script>
