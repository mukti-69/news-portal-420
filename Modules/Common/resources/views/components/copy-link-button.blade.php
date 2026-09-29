<button class="btn btn-sm btn-secondary btn-icon round d-flex justify-content-center align-items-center copy-link-button"
        data-url="{{ $url }}"
        rel="tooltip" aria-label="লিংক কপি করুন" data-bs-original-title="লিংক কপি করুন">
    <i class="far fa-copy"></i>
</button>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.copy-link-button').forEach(button => {
            button.addEventListener('click', function () {
                const url = this.getAttribute('data-url');
                navigator.clipboard.writeText(url).then(() => {
                    swal.fire({
                        icon: 'success',
                        title: 'কপি হয়েছে!',
                        text: 'লিংক সফলভাবে কপি হয়েছে।',
                        confirmButtonText: 'ঠিক আছে'
                    });
                }).catch(err => {
                    Sweetalert2.fire({
                        icon: 'error',
                        title: 'ত্রুটি!',
                        text: 'লিংক কপি করতে সমস্যা হয়েছে।',
                        confirmButtonText: 'ঠিক আছে'
                    });
                });
            });
        });
    });
</script>
