<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/js-cookie/js.cookie.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
<!-- Argon JS -->
<script src="{{ asset('assets/js/argon.js?v=1.2.0') }}"></script>
<!-- Data tables -->
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.carousel').carousel('pause');
        $('#data').DataTable();
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passNew = document.getElementById('password_new');
        const passConfirm = document.getElementById('password_new_confirmation');
        const oldPass = document.getElementById('password');
        const err = document.getElementById('password-match-error');

        // tombol submit
        const submitBtn = document.querySelector('input[type="submit"][name="submit"]');

        function setInvalid(message) {
            err.style.display = 'block';
            err.textContent = message;

            passConfirm.classList.add('is-invalid');
            passConfirm.classList.remove('is-valid');

            // disable submit
            if (submitBtn) submitBtn.disabled = true;
        }

        function setValid() {
            err.style.display = 'none';
            err.textContent = '';

            passConfirm.classList.remove('is-invalid');

            // kalau confirm ada isinya dan match, kasih is-valid biar ada feedback bagus
            if (passConfirm.value.length > 0) passConfirm.classList.add('is-valid');

            // enable submit
            if (submitBtn) submitBtn.disabled = false;
        }

        function resetState() {
            err.style.display = 'none';
            err.textContent = '';
            passConfirm.classList.remove('is-invalid', 'is-valid');
            if (submitBtn) submitBtn.disabled = false;
        }

        function validateMatch() {
            const newVal = passNew.value;
            const confVal = passConfirm.value;

            // kalau user belum niat ganti password (semua kosong) -> aman
            if (!oldPass.value && !newVal && !confVal) {
                resetState();
                return;
            }

            // kalau user mulai isi password baru/konfirmasi tapi masih kosong salah satunya
            if ((newVal && !confVal) || (!newVal && confVal)) {
                setInvalid('Password baru dan konfirmasi harus diisi keduanya.');
                return;
            }

            // kalau dua-duanya terisi tapi tidak sama
            if (newVal && confVal && newVal !== confVal) {
                setInvalid('Konfirmasi password baru tidak sama.');
                return;
            }

            // kalau match
            if (newVal && confVal && newVal === confVal) {
                setValid();
                return;
            }

            // default fallback
            resetState();
        }

        // realtime
        [passNew, passConfirm, oldPass].forEach(el => {
            el.addEventListener('input', validateMatch);
            el.addEventListener('blur', validateMatch);
        });

        // initial state
        validateMatch();
    });
</script>
