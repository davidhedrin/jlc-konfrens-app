<div>
    @if(Session::has('msgUsers'))
    <div class="bs-toast toast fade show bg-success toast-placement-ex top-0 end-0"
        style="margin-top: 90px; margin-right: 25px" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Successfully!</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ Session::get('msgUsers') }}
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="card-header row">
                    <div class="col-md-6">
                        <h5 class="mb-0">Tabel Daftar Jemaat:</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-end">
                            <div style="margin-right: 10px">
                                <input wire:model="search" class="form-control" style="width: 250px" type="search" id="search-user" placeholder="Temukan User...">
                            </div>
                            <div>
                                <button type="button" class="btn btn-success mr-3" data-bs-toggle="modal" data-bs-target="#modal-fromAdd-user">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="dataTableAsset">
                            <thead>
                                <tr>
                                    <th width="10"><strong>No</strong></th>
                                    <th><strong>User ID</strong></th>
                                    <th><strong>Nama</strong></th>
                                    <th><strong>Email</strong></th>
                                    <th><strong>Phone</strong></th>
                                    <th><strong>U-Type</strong></th>
                                    <th class="text-center"><strong>Status</strong></th>
                                    <th class="text-center" width="80"><strong>Actions</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($i = 1)
                                @forelse ($users as $u)
                                <tr>
                                    <?php
                                        $kodeJem = null;
                                        $kodeJab = null;
                                        if ($u->jemaat_id) {
                                            $kodeJem = $u->jemaat->kode_jemaat;
                                        }
                                        if ($u->jabatan_id) {
                                            $kodeJab = $u->jabatan->kode_jabatan;
                                        }
                                    ?>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $kodeJem != null ? $kodeJem : "!" }}{{ $kodeJab != null ? $kodeJab : "!" }}</td>
                                    <td>{{ $u->name }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td>{{ $u->no_phone }}</td>
                                    <td>{{ $u->user_type }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <span class="badge bg-label-{{ $u->flag_active == "Y" ? "success" : ($u->flag_active == "N" ? "danger" : "warning") }}">{{ $u->flag_active == "Y" ? "Active" : ($u->flag_active == "N" ? "Inactive" : "Panding") }}</span>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                <a class="dropdown-item text-success" href="javascript:void(0);" wire:click="activeUser({{ $u->id }})">Active</a>
                                                <a class="dropdown-item text-danger" href="javascript:void(0);" wire:click="inactiveUser({{ $u->id }})">Inactive</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modal-fromUpdate-user" wire:click="editDataUser({{ $u->id }})"><i class="bx bx-edit-alt me-1"></i></a>
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modal-fromDelete-user" wire:click="deleteJemaat({{ $u->id }})"><i class="bx bx-trash me-1"></i></a>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="8">Data kosong/tidak ditemukan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Add -->
    <div wire:ignore.self class="modal fade" id="modal-fromAdd-user" data-bs-backdrop="static" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Form Daftar User:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="resetFromAddUsers"></button>
                </div>
                <form wire:submit.prevent="storeNewUser">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jemaat_id" class="form-label">Jemaat <span class="text-danger">*</span></label>
                                    <select class="form-select" id="jemaat_id" wire:model="selectJemaat" wire:click="generateUserId" autofocus>
                                        <option value="">Pilih Jemaat</option>
                                        @foreach ($jemaats as $jem)
                                            <option value="{{ $jem->id }}">{{ $jem->nama_jemaat }}</option>
                                        @endforeach
                                    </select>
                                    @error('selectJemaat') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jabatan_id" class="form-label">Jabatan <span class="text-danger">*</span></label>
                                    <select class="form-select" id="jabatan_id" wire:model="selectJabatan" wire:click="generateUserId" autofocus>
                                        <option value="">Pilih Jabatan</option>
                                        @foreach ($jabatans as $jab)
                                            <option value="{{ $jab->id }}">{{ $jab->nama_jabatan }}</option>
                                        @endforeach
                                    </select>
                                    @error('selectJabatan') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="user_id" class="form-label">User ID </label> <span class="text-danger" style="font-style: italic; font-size: 11px">(auto)</span>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class='bx bx-barcode-reader'></i></span>
                                    <input wire:model="user_id" type="text" class="form-control" id="user_id" placeholder=" User ID Otomatis Terisi" readonly autofocus />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="flagAct" class="form-label">Status</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class='bx bxs-flag-alt' ></i></span>
                                    <select wire:model="flag_active" class="form-select" id="flagAct" autofocus>
                                        <option value="">Pilih Status</option>
                                        <option value="Y">Active</option>
                                        <option value="N">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Fullname <span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class='bx bxs-user-badge'></i></span>
                                    <input wire:model="name" type="text" class="form-control" id="name" placeholder="Masukkan Nama Lengkap" autofocus />
                                </div>
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="user_type" class="form-label">Tipe User <span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class='bx bxs-user-badge'></i></span>
                                    <select wire:model="user_type" class="form-select" id="user_type" autofocus>
                                        <option value="">Pilih Tipe</option>
                                        <option value="ADM">Admin</option>
                                        <option value="USR">User</option>
                                        <option value="JMT">Jemaat</option>
                                    </select>
                                </div>
                                @error('user_type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class='bx bx-envelope'></i></span>
                                    <input wire:model="email" type="text" class="form-control" id="email" placeholder="Masukkan Alamat Email" autofocus />
                                </div>
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="no_phone" class="form-label">Nomor Hp <span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class='bx bx-mobile-alt' ></i></span>
                                    <input wire:model="no_phone" type="text" class="form-control" id="no_phone" placeholder="Masukkan Nomor Telpon" autofocus />
                                </div>
                                @error('no_phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                                <div class="form-password-toggle">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class='bx bx-lock' ></i></span>
                                        <input wire:model="password" type="password" id="password" class="form-control" placeholder="************"/>
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="password_confirmation">C-Password <span class="text-danger">*</span></label>
                                <div class="form-password-toggle">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class='bx bx-lock' ></i></span>
                                        <input wire:model="conf_password" type="password" id="password_confirmation" class="form-control" placeholder="************"/>
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                    @error('conf_password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <span style="font-style: italic; font-size:12px">Kolom dengan tanda bintang merah <span class="text-danger">(*)</span> wajib diisi</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"
                            wire:click="resetFromAddUsers">
                            Close
                        </button>
                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Edit -->
    <div wire:ignore.self class="modal fade" id="modal-fromUpdate-user" data-bs-backdrop="static" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Form Daftar User:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="resetFromAddUsers"></button>
                </div>
                <form wire:submit.prevent="updateDataUser">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jemaat_id" class="form-label">Jemaat <span class="text-danger">*</span></label>
                                    <select class="form-select" id="jemaat_id" wire:model="selectJemaat" wire:change="generateUserId">
                                        <option value="">Pilih Jemaat</option>
                                        @foreach ($jemaats as $jem)
                                            <option value="{{ $jem->id }}">{{ $jem->nama_jemaat }}</option>
                                        @endforeach
                                    </select>
                                    @error('selectJemaat') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jabatan_id" class="form-label">Jabatan <span class="text-danger">*</span></label>
                                    <select class="form-select" id="jabatan_id" wire:model="selectJabatan" wire:change="generateUserId">
                                        <option value="">Pilih Jabatan</option>
                                        @foreach ($jabatans as $jab)
                                            <option value="{{ $jab->id }}">{{ $jab->nama_jabatan }}</option>
                                        @endforeach
                                    </select>
                                    @error('selectJabatan') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-3">
                            <div class="col-md-6 mb-3">
                                <label for="user_id" class="form-label">User ID </label> <span class="text-danger" style="font-style: italic; font-size: 11px">(auto)</span>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class='bx bx-barcode-reader'></i></span>
                                    <input wire:model="user_id" type="text" class="form-control" id="user_id" placeholder=" User ID Otomatis Terisi" readonly />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="flagAct" class="form-label">Status</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class='bx bxs-flag-alt' ></i></span>
                                    <select wire:model="flag_active" class="form-select" id="flagAct">
                                        <option value="">Pilih Status</option>
                                        <option value="Y">Active</option>
                                        <option value="N">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Fullname <span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class='bx bxs-user-badge'></i></span>
                                    <input wire:model="name" type="text" class="form-control" id="name" placeholder="Masukkan Nama Lengkap" />
                                </div>
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="user_type" class="form-label">Tipe User <span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class='bx bxs-user-badge'></i></span>
                                    <select wire:model="user_type" class="form-select" id="user_type">
                                        <option value="">Pilih Tipe</option>
                                        <option value="ADM">Admin</option>
                                        <option value="USR">User</option>
                                        <option value="JMT">Jemaat</option>
                                    </select>
                                </div>
                                @error('user_type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class='bx bx-envelope'></i></span>
                                    <input wire:model="email" type="text" class="form-control" id="email" placeholder="Masukkan Alamat Email" />
                                </div>
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="no_phone" class="form-label">Nomor Hp <span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class='bx bx-mobile-alt' ></i></span>
                                    <input wire:model="no_phone" type="text" class="form-control" id="no_phone" placeholder="Masukkan Nomor Telpon" />
                                </div>
                                @error('no_phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                                <div class="form-password-toggle">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class='bx bx-lock' ></i></span>
                                        <input wire:model="newPassword" type="password" id="password" class="form-control" placeholder="************"/>
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
                                        <input wire:model="newconf_password" type="password" id="password_confirmation" class="form-control" placeholder="************"/>
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                    @error('newconf_password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <span style="font-style: italic; font-size:12px">Kolom dengan tanda bintang merah <span class="text-danger">(*)</span> wajib diisi</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"
                            wire:click="resetFromAddUsers">
                            Close
                        </button>
                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Delete -->
    <div wire:ignore.self class="modal fade" id="modal-fromDelete-user" tabindex="-1" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class='bx bx-info-circle mb-2' style="color:lightblue; font-size: 100px"></i>
                    <h4>Konfirmasi Delete</h4>
                    <span>Yakin ingin menghapus user?</span>
                    <div class="mt-3">
                        <form action="" wire:submit.prevent="destroyUser">
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
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

<script type="text/javascript">    
    window.addEventListener('close-form-modal', event => {
        $('#modal-fromAdd-user').modal('hide');
        $('#modal-fromUpdate-user').modal('hide');
        $('#modal-fromDelete-user').modal('hide');
    });
</script>