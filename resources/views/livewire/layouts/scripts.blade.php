<script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
<script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/compiled/js/app.js') }}"></script>
<script src="{{ asset('assets/extensions/toastify-js/src/toastify.js') }}"></script>
<script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
<script>
    window.addEventListener('toastify', event => {
        let data = event.detail[0];
        Toastify({
            text: data.text,
            duration: data.duration,
            close: data.close,
            gravity: data.gravity,
            position: data.position,
            backgroundColor: data.color,
            avatar: data.avatar,
        }).showToast();
    });


    window.addEventListener('choices', event => {
        setTimeout(() => {
            let choices = document.querySelectorAll(".choices");
            let initChoice;
            for (let i = 0; i < choices.length; i++) {
                if (choices[i].classList.contains("multiple-remove")) {
                    initChoice = new Choices(choices[i], {
                        delimiter: ",",
                        editItems: true,
                        maxItemCount: -1,
                        removeItemButton: true,
                    });
                } else {
                    initChoice = new Choices(choices[i]);
                }
            }
        }, 500);
    });


    window.addEventListener('closeModal', event => {
        const modalElements = document.getElementsByClassName('modal');

        for (const modalElement of modalElements) {
            const dismissButton = modalElement.querySelector('[data-bs-dismiss="modal"]');
            dismissButton.click();
        }
    });
</script>
@stack('add-scripts')
