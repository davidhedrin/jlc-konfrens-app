<div>
    @if(Session::has('msgUpdateUser'))
    <div class="bs-toast toast fade show bg-success toast-placement-ex top-0 end-0"
        style="margin-top: 90px; margin-right: 25px" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Successfully!</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ Session::get('msgUpdateUser') }}
        </div>
    </div>
    @elseif (Session::has('msgLimitRequest'))
    <div class="bs-toast toast fade show bg-warning toast-placement-ex top-0 end-0"
        style="margin-top: 90px; margin-right: 25px" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Failed!</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ Session::get('msgLimitRequest') }}<span class="text-danger">{{ Session::get('msgLimitSecRequest') }}</span> detik
        </div>
    </div>
    @elseif (Session::has('msgWrongPass'))
    <div class="bs-toast toast fade show bg-warning toast-placement-ex top-0 end-0"
        style="margin-top: 30px; margin-right: 25px" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Failed!</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ Session::get('msgWrongPass') }}
        </div>
    </div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-start  gap-4">
                <img src="../assets/img/avatars/1.png" alt="user-avatar" class="d-block rounded" height="110"
                    width="110" id="uploadedAvatar" />
                <div class="button-wrapper">
                    <h4 class="fw-bold">{{ $profile->name }}</h4>
                    <label for="upload" class="btn btn-primary mb-2" tabindex="0">
                        <span class="d-none d-sm-block">Upload new photo</span>
                        <i class="bx bx-upload d-block d-sm-none"></i>
                        <input type="file" id="upload" class="account-file-input" hidden
                            accept="image/png, image/jpeg" />
                    </label>
                    <button type="button" class="btn btn-outline-secondary account-image-reset mb-2">
                        <i class="bx bx-reset d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Reset</span>
                    </button>
                    <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                </div>
            </div>
        </div>
        <hr class="my-0" />
        <div class="card-body">
            <div class="row">
                @php
                $jemaat = null;
                $jabatan = null;
                $namaJem = null;
                $namaJab = null;
                if ($profile->jemaat_id) {
                    $jemaat = $profile->jemaat->kode_jemaat;
                    $namaJem = $profile->jemaat->nama_jemaat;
                }
                if ($profile->jabatan_id) {
                    $jabatan = $profile->jabatan->kode_jabatan;
                    $namaJab = $profile->jabatan->nama_jabatan;
                }
                @endphp
                <div class="mb-3 col-md-3">
                    <label for="userId" class="form-label">User ID</label>
                    <input class="form-control" type="text" id="userId" value="{{ $jemaat != null ? $jemaat : "!" }}{{ $jabatan != null ? $jabatan : "!" }}" readonly />
                </div>
                <div class="mb-3 col-md-3">
                    <label for="tipeAkun" class="form-label">Tipe Akun</label>
                    <input class="form-control" type="text" id="tipeAkun" value="{{ $profile->user_type }} ({{ $profile->user_type == 'ADM' ? 'Admin' : ($profile->user_type == 'USR' ? 'User' : 'Jemaat') }})" readonly />
                </div>
                <div class="mb-3 col-md-3">
                    <label for="jemaat" class="form-label">Jemaat</label>
                    <input class="form-control" type="text" id="jemaat" value="{{ $namaJem != null ? $namaJem : "!" }}" readonly />
                </div>
                <div class="mb-3 col-md-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input class="form-control" type="text" id="jabatan" value="{{ $namaJab != null ? $namaJab : "!" }}" readonly />
                </div>
                <hr class="mb-3 mt-2" />

                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input wire:model="email" class="form-control" type="text" id="email" placeholder="Masukkan Alamat Email" />
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label for="no_phone" class="form-label">Nomor HP</label>
                    <input wire:model="no_phone" type="text" class="form-control" id="no_phone" placeholder="Masukkan Nomor Telepon" />
                    @error('no_phone') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                
                <div class="mb-3 col-md-12">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input wire:model="name" class="form-control" type="text" id="nama_lengkap" placeholder="Masukkan Nama Lengkap" />
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mt-2">
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-konfirmasi-edit" class="btn btn-primary me-2">Simpan</button>
            </div>
        </div>
        <!-- /Account -->
    </div>
    
    <div class="card mb-4">
        <h5 class="card-header">Ganti Password</h5>
        <div class="card-body">
            <div class="mb-3 col-12 mb-0">
                <div class="alert alert-info">
                <h6 class="alert-heading fw-bold mb-1">Pastikan anda mengingat sandi baru yang anda buat!</h6>
                <p class="mb-0">Jika lupa dengan kata sandi, lakukan setel ulang kata sandi dimenu login, atau minta admin mengatur ulang.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="newPassword">Password <span class="text-danger">*</span></label>
                    <div class="form-password-toggle">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class='bx bx-lock' ></i></span>
                            <input wire:model="newPassword" type="password" id="newPassword" class="form-control" placeholder="Masukkan Kata Sandi"/>
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                        @error('newPassword') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="password_confirmation">C-Password <span class="text-danger">*</span></label>
                    <div class="form-password-toggle">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class='bx bx-lock' ></i></span>
                            <input wire:model="newConfirmPass" type="password" id="password_confirmation" class="form-control" placeholder="Masukkan Konfirmasi Kata Sandi"/>
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                        @error('newConfirmPass') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input wire:model="setujuPassword" class="form-check-input" type="checkbox" name="termKataSandi" id="termKataSandi" />
                    <label class="form-check-label" for="termKataSandi" >Saya setuju mengatur ulang kata sandi</label>
                </div>
                @error('setujuPassword') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button type="button" class="btn btn-primary deactivate-account" wire:click="CheckFieldResetPass">Ubah Sandi</button>
        </div>
    </div>

    <div class="card">
        <h5 class="card-header">Delete Account</h5>
        <div class="card-body">
          <div class="mb-3 col-12 mb-0">
            <div class="alert alert-warning">
              <h6 class="alert-heading fw-bold mb-1">Apa anda yakin ingin menghapus akun ini?</h6>
              <p class="mb-0">Setelah Anda menghapus akun Anda, tidak ada jalan untuk kembali. Harap yakin!</p>
            </div>
          </div>
          <form wire:submit.prevent="checkDeleteField">
            <div class="mb-3">
                <div class="form-check">
                  <input wire:model="setujuDelete" class="form-check-input" type="checkbox" name="konfirmDelete" id="konfirmDelete" />
                  <label class="form-check-label" for="konfirmDelete" >Saya setuju untuk menghapus akun</label>
                </div>
                @error('setujuDelete') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn btn-danger deactivate-account">Hapus Akun</button>
          </form>
        </div>
    </div>

    <!-- Modal Konfirmasi Update -->
    <div wire:ignore.self class="modal fade" id="modal-konfirmasi-edit" tabindex="-1" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class='bx bx-info-circle mb-2' style="color:lightblue; font-size: 100px"></i>
                    <h4>Konfirmasi Update</h4>
                    <span>Yakin ingin mengubah data?</span>
                    <div class="mt-3">
                        <form wire:submit.prevent="updateDataUser">
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Konfirmasi Reset Password -->
    <div wire:ignore.self class="modal fade" data-bs-backdrop="static" id="modal-konfirmasi-kataSandi" tabindex="-1" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class='bx bx-lock mb-2' style="color:lightblue; font-size: 100px"></i>
                    <h4>Konfirmasi Update</h4>
                    <span>Yakin ingin mengubah kata sandi?</span>
                    <div class="mt-3">
                        <form wire:submit.prevent="updateNewPassword">
                            <div class="form-password-toggle mb-4">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class='bx bx-lock' ></i></span>
                                    <input wire:model="oldPassword" type="password" id="oldPassword" class="form-control" placeholder="Masukkan Kata Sandi" required/>
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <button wire:click="fieldResetPassword" type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Konfirmasi Delete Akun -->
    <div wire:ignore.self class="modal fade" data-bs-backdrop="static" id="modal-konfirmasi-deleteAkun" tabindex="-1" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class='bx bx-tired mb-2' style="color:rgb(245, 200, 51); font-size: 100px"></i>
                    <h4>Konfirmasi Delete</h4>
                    <span>Yakin ingin mengubah menghapus akun? <br> Setelah Anda menghapus akun Anda, tidak ada jalan untuk kembali. Harap yakin!</span>
                    <div class="mt-3">
                        <form wire:submit.prevent="confirmationDeleteAccount">
                            <div class="form-password-toggle mb-4">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class='bx bx-lock' ></i></span>
                                    <input wire:model="oldPassword" type="password" id="oldPassword" class="form-control" placeholder="Masukkan Kata Sandi" required/>
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <button wire:click="fieldResetPassword" type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-sm btn-primary">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener('close-form-modal', event => {
        $('#modal-konfirmasi-edit').modal('hide');
        $('#modal-konfirmasi-kataSandi').modal('hide');
        $('#modal-konfirmasi-deleteAkun').modal('hide');
    });
    window.addEventListener('open-form-modal', event => {
        $('#modal-konfirmasi-kataSandi').modal('show');
    });
    window.addEventListener('open-delete-modal', event => {
        $('#modal-konfirmasi-deleteAkun').modal('show');
    });
</script>