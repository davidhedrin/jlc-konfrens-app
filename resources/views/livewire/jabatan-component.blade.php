<div>
    @if(Session::has('msgJabatan'))
    <div class="bs-toast toast fade show bg-success toast-placement-ex top-0 end-0"
        style="margin-top: 90px; margin-right: 25px" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Successfully!</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ Session::get('msgJabatan') }}
        </div>
    </div>
    @endif
    
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="card-header row">
                    <div class="col-md-6">
                        <h5 class="mb-0">Tabel Jabatan Jemaat:</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-end">
                            <div style="margin-right: 10px">
                                <input wire:model="search" class="form-control" style="width: 250px" type="search" id="search-user" placeholder="Temukan Jabatan...">
                            </div>
                            <div>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#modal-fromAdd-jabatan">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="dataTableAsset">
                            <thead>
                                <tr>
                                    <th width="20"><strong>No</strong></th>
                                    <th><strong>Kode</strong></th>
                                    <th><strong>Nama Jabatan</strong></th>
                                    <th><strong>Ket Jabatan</strong></th>
                                    <th width="80"><strong>Actions</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($i = 1)
                                @forelse ($jabatans as $jab)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $jab->kode_jabatan }}</td>
                                    <td>{{ $jab->nama_jabatan }}</td>
                                    <td>{{ $jab->ket_jabatan }}</td>
                                    <td class="text-center">
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modal-fromUpdate-jabatan" wire:click="editJabatan({{ $jab->id }})"><i class="bx bx-edit-alt me-1"></i></a>
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modal-fromDelete-jabatan" wire:click="deleteJabatan({{ $jab->id }})"><i class="bx bx-trash me-1"></i></a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="4">Data Kosong/Tidak Ditemukan!</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $jabatans->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
        @forelse ($jabatanCards as $jab)
        <div class="col">
            <div class="card h-100 text-center">
                <span class="fw-bold mt-4" style="font-size: 50px">{{ $jab->kode_jabatan }}</span>
                <div class="card-body">
                    <h5 class="card-title">{{ $jab->nama_jabatan }}</h5>
                    <p class="card-text">
                    {{ $jab->ket_jabatan }}
                    </p>
                </div>
            </div>
        </div>
        @empty
        <tr>
            <td class="text-center" colspan="4">Data Kosong/Tidak Ditemukan!</td>
        </tr>
        @endforelse
    </div>
    
    <!-- Modal Add -->
    <div wire:ignore.self class="modal fade" id="modal-fromAdd-jabatan" data-bs-backdrop="static" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Form Jabatan Jemaat:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="resetFromJabatan"></button>
                </div>
                <form wire:submit.prevent="storeJabatan">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="kode_jabatan">Kode Jabatan <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <span id="kode_jabatan2" class="input-group-text"><i
                                        class="bx bx-user"></i></span>
                                <input wire:model="kode_jabatan" type="text" class="form-control"
                                    id="kode_jabatan" placeholder="Masuukan Kode Jabatan" />
                            </div>
                            @error('kode_jabatan') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="nama_jabatan">Nama Jabatan <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <span id="nama_jabatan2" class="input-group-text"><i class="bx bx-buildings"></i></span>
                                <input wire:model="nama_jabatan" type="text" id="nama_jabatan"
                                    class="form-control" placeholder="Masukkan Nama Jabatan" />
                            </div>
                            @error('nama_jabatan') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="ket_jabatan">Keterangan</label>
                            <div class="input-group input-group-merge">
                                <span id="ket_jabatan2" class="input-group-text"><i class="bx bx-buildings"></i></span>
                                <textarea wire:model="ket_jabatan" id="ket_jabatan"
                                    class="form-control" placeholder="Masukkan Keterangan Jabatan"></textarea>
                            </div>
                            @error('ket_jabatan') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <span style="font-style: italic; font-size:12px">Kolom dengan tanda bintang merah <span class="text-danger">(*)</span> wajib diisi</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"
                            wire:click="resetFromJabatan">
                            Close
                        </button>
                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Edit -->
    <div wire:ignore.self class="modal fade" id="modal-fromUpdate-jabatan" data-bs-backdrop="static" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Edit Jabatan Jemaat:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="resetFromJabatan"></button>
                </div>
                <form wire:submit.prevent="updateJabatan">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Kode Jabatan</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class="bx bx-user"></i></span>
                                <input wire:model="kode_jabatan" type="text" class="form-control"
                                    id="basic-icon-default-fullname" placeholder="Masuukan Kode Jabatan" />
                            </div>
                            @error('kode_jabatan') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-company">Nama Jabatan</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text"><i
                                        class="bx bx-buildings"></i></span>
                                <input wire:model="nama_jabatan" type="text" id="basic-icon-default-company"
                                    class="form-control" placeholder="Masukkan Nama Jabatan" />
                            </div>
                            @error('nama_jabatan') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="ket_jabatan">Keterangan</label>
                            <div class="input-group input-group-merge">
                                <span id="ket_jabatan2" class="input-group-text"><i class="bx bx-buildings"></i></span>
                                <textarea wire:model="ket_jabatan" id="ket_jabatan"
                                    class="form-control" placeholder="Masukkan Keterangan Jabatan"></textarea>
                            </div>
                            @error('ket_jabatan') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <span style="font-style: italic; font-size:12px">Kolom dengan tanda bintang merah <span class="text-danger">(*)</span> wajib diisi</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"
                            wire:click="resetFromJabatan">
                            Close
                        </button>
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Delete -->
    <div wire:ignore.self class="modal fade" id="modal-fromDelete-jabatan" tabindex="-1" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class='bx bx-info-circle mb-2' style="color:lightblue; font-size: 100px"></i>
                    <h4>Konfirmasi Delete</h4>
                    <span>Yakin ingin menghapus data?</span>
                    <div class="mt-3">
                        <form action="" wire:submit.prevent="destroyJabatan">
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

<script>
    window.addEventListener('close-form-modal', event => {
        $('#modal-fromAdd-jabatan').modal('hide');
        $('#modal-fromUpdate-jabatan').modal('hide');
        $('#modal-fromDelete-jabatan').modal('hide');
    });
</script>