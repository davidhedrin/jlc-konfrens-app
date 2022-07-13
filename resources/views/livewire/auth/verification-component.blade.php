<div>
    @if(Session::has('msgEmailVerify'))
    <div class="bs-toast toast fade show bg-success toast-placement-ex top-0 end-0"
        style="margin-top: 30px; margin-right: 25px" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Successfully!</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ Session::get('msgEmailVerify') }}
        </div>
    </div>
    @elseif (Session::has('msgEmailVerifyLimit'))
    <div class="bs-toast toast fade show bg-warning toast-placement-ex top-0 end-0"
        style="margin-top: 30px; margin-right: 25px" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Successfully!</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ Session::get('msgEmailVerifyLimit') }} <span class="text-danger">{{ Session::get('msgEmailSecLimit') }}</span> detik.
        </div>
    </div>
    @endif
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/img/icons/gmahkLogo.png') }}" alt="Logo" width="100">
                    </div>
                    <h2 class="mb-3 text-center"><strong>Konfrens DKI</strong></h2>

                    <!-- /Logo -->
                    <h3 class="mb-2 text-center">Verifikasi E-Mail! <i class='bx bxs-envelope'
                            style="font-size: 40px"></i></h3>
                    <p class="mb-4 text-center">Selamat akun anda telah <span class="text-success">Disetujui</span>.
                        Sebelum lanjut, mohon verifikasi E-Mail terlebih dahulu.</p>

                    <button class="btn btn-primary d-grid w-100" data-bs-toggle="modal"
                        data-bs-target="#modal-loadingEmail-verify" wire:click="sendEmailVerify">Kirim Verifikasi E-Mail</button>
                    <div class="mt-3 text-center">
                        Kembali kehalaman <a href="{{ route('logout') }}">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="modal-loadingEmail-verify" tabindex="-1" data-bs-backdrop="static"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="card-body d-flex justify-content-center">
                    <table>
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <h3>Kirim Verifikasi Email</h3>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <div class="spinner-border text-dark" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <h5 class="mt-2 mb-0">Mohon tunggu...</h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    window.addEventListener('close-form-modal', event => {
        $('#modal-loadingEmail-verify').modal('hide');
    });
</script>