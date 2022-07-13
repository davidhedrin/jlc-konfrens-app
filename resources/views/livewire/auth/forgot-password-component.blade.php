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
                    <h4 class="mb-2 text-center">Lupa Password <i class='bx bx-lock-open' style="font-size: 30px"></i></h4>
                    <p class="mb-4 text-center">Masukkan email Anda dan kami akan mengirimkan instruksi untuk mereset kata sandi Anda</p>

                    <form wire:submit.prevent="sendLinkResetPass" class="mb-3">
                        <div class="mb-3">
                            <input
                              type="text"
                              class="form-control"
                              id="text"
                              placeholder="Masukkan Alamat E-Mail"
                              autofocus
                              wire:model="email"
                            />
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                          </div>
                          <button type="submit" data-bs-toggle="modal" data-bs-target="#modal-loadingForgot-pass" class="btn btn-primary d-grid w-100">Kirim Link</button>
                    </form>
                    <p class="text-center">
                        <span>Kembali untuk</span>
                        <a href="{{ route('login') }}">
                            <span>Login</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modal-loadingForgot-pass" tabindex="-1" data-bs-backdrop="static"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="card-body d-flex justify-content-center">
                    <table>
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <h3>Periksa Email Masuk</h3>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <div class="spinner-border text-dark" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <h5 class="mt-2 mb-0">Dalam proses...</h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
