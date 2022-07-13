<div>
    <style>
        .centers-contens{
            position: relative;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }
    </style>
    <div class="authentication-wrapper2 authentication-basic2 container-p-y">
        <div class="authentication-inner2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="centers-contens">
                                <div class="text-center">
                                    <img src="{{ asset('assets/img/icons/gmahkLogo.png') }}" alt="Logo" width="100">
                                </div>
                                <h2 class="mb-3 text-center"><strong>Konfrens DKI</strong></h2>
            
                                <h4 class="mb-2 text-center">Atur Ulang Password 🚀</h4>
                                <p class="mb-2 text-center">Pastikan untuk mengingat password baru!</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <form wire:submit.prevent="saveNewPassword">
                                <div class="mb-3">
                                    <label for="user_id" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="user_id" wire:model="email"
                                        placeholder="User ID Otomatis Terisi" readonly />
                                    @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="password">Password Baru <span class="text-danger">*</span></label>
                                    <div class="form-password-toggle">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class='bx bx-lock' ></i></span>
                                            <input wire:model="newPassword" type="password" id="password" class="form-control" placeholder="************"/>
                                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                        </div>
                                        @error('newPassword') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="password_confirmation">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                                    <div class="form-password-toggle">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class='bx bx-lock' ></i></span>
                                            <input wire:model="confNewPassword" type="password" id="password_confirmation" class="form-control" placeholder="************"/>
                                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                        </div>
                                        @error('confNewPassword') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary d-grid w-100">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>