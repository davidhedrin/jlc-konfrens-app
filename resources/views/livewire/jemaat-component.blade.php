<div>
    @if(Session::has('msgJemaat'))
    <div class="bs-toast toast fade show bg-success toast-placement-ex top-0 end-0"
        style="margin-top: 90px; margin-right: 25px" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Successfully!</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ Session::get('msgJemaat') }}
        </div>
    </div>
    @endif
    
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="card-header row">
                    <div class="col-md-6">
                        <h5 class="mb-0">Tabel Daftar User:</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-end">
                            <div style="margin-right: 10px">
                                <input wire:model="search" class="form-control" style="width: 250px" type="search" name="search-user" id="search-user" placeholder="Temukan Jemaat">
                            </div>
                            <div>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-fromAdd-jemaat">Tambah</button>
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
                                    <th class="text-center"><strong>Gambar</strong></th>
                                    <th><strong>Kode</strong></th>
                                    <th><strong>Nama Jemaat</strong></th>
                                    <th><strong>Alamat</strong></th>
                                    <th class="text-center"><strong>Status</strong></th>
                                    <th class="text-center" width="80"><strong>Actions</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($i = 1)
                                @forelse ($jemaats as $jem)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td class="text-center">
                                            @if ($jem->image)
                                                <img src="{{ asset('assets/img/jemaats') }}/{{ $jem->image }}" alt="Logo" height="50">
                                            @else
                                                <img src="{{ asset('assets/img/noImageJemaat.png') }}" alt="Logo" height="40">
                                                <div style="font-size: 12px; font-style:italic">No Image</div>
                                            @endif
                                        </td>
                                        <td>{{ $jem->kode_jemaat }}</td>
                                        <td>{{ $jem->nama_jemaat }}</td>
                                        <td>{{ $jem->alamat }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <span class="badge bg-label-{{ $jem->flag_active == "Y" ? "success" : ($jem->flag_active == "N" ? "danger" : "warning") }}">{{ $jem->flag_active == "Y" ? "Active" : ($jem->flag_active == "N" ? "Inactive" : "Panding") }}</span>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                    <a class="dropdown-item text-success" href="javascript:void(0);" wire:click="activeJemaat({{ $jem->id }})">Active</a>
                                                    <a class="dropdown-item text-danger" href="javascript:void(0);" wire:click="inactiveJemaat({{ $jem->id }})">Inactive</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modal-fromUpdate-jemaat" wire:click="editJemaat({{ $jem->id }})"><i class="bx bx-edit-alt me-1"></i></a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modal-fromDelete-jemaat" wire:click="deleteJemaat({{ $jem->id }})"><i class="bx bx-trash me-1"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="8">Data Kosong/Tidak Ditemukan!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $jemaats->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Add -->
    <div wire:ignore.self class="modal fade" id="modal-fromAdd-jemaat" data-bs-backdrop="static" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Form Daftar Jemaat:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="resetFromAddJemaat"></button>
                </div>
                <form wire:submit.prevent="storeJemaatBaru">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="kode-jemaat">Kode Jemaat <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bx-barcode-reader' ></i></span>
                                        <input wire:model="kode_jemaat" type="text" class="form-control" id="kode-jemaat" placeholder="Masuukan Kode Jabatan" />
                                    </div>
                                    @error('kode_jemaat') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="status-jemaat">Status Jemaat <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <span id="status-jemaat2" class="input-group-text"><i class='bx bxs-flag-alt'></i></span>
                                        <select class="form-select" name="status-jemaat" id="status-jemaat" wire:model="flag_active">
                                            <option value="">Pilih Status Aktif</option>
                                            <option value="Y">Active</option>
                                            <option value="N">Inactive</option>
                                        </select>
                                    </div>
                                    @error('flag_active') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="nama-jemaat">Nama Jemaat <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <span id="nama-jemaat2" class="input-group-text"><i class="bx bx-buildings"></i></span>
                                <input wire:model="nama_jemaat" type="text" id="nama-jemaat" class="form-control" placeholder="Masukkan Nama Jabatan" />
                            </div>
                            @error('nama_jemaat') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="alamat-jemaat">Alamat Jemaat <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <span id="alamat-jemaat2" class="input-group-text"><i class='bx bx-map-alt'></i></span>
                                <textarea wire:model="alamat" id="alamat-jemaat" class="form-control" placeholder="Masukkan Alamat Jemaat"></textarea>
                            </div>
                            @error('alamat') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="image-jemaat">Gambar Jemaat</label>
                            <div class="input-group input-group-merge">
                                <span id="image-jemaat2" class="input-group-text"><i class='bx bx-image-add' ></i></span>
                                <input class="form-control" type="file" id="image-jemaat" wire:model="image" />
                            </div>
                            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <span style="font-style: italic; font-size:12px">Kolom dengan tanda bintang merah <span class="text-danger">(*)</span> wajib diisi</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"
                            wire:click="resetFromAddJemaat">
                            Close
                        </button>
                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Edit -->
    <div wire:ignore.self class="modal fade" id="modal-fromUpdate-jemaat" data-bs-backdrop="static" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Form Daftar Jemaat:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="resetFromAddJemaat"></button>
                </div>
                <form wire:submit.prevent="updateJemaat">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="kode-jemaat">Kode Jemaat <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bx-barcode-reader' ></i></span>
                                        <input wire:model="kode_jemaat" type="text" class="form-control" id="kode-jemaat" placeholder="Masuukan Kode Jabatan" />
                                    </div>
                                    @error('kode_jemaat') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="status-jemaat">Status Jemaat</label>
                                    <div class="input-group input-group-merge">
                                        <span id="status-jemaat2" class="input-group-text"><i class='bx bxs-flag-alt'></i></span>
                                        <select class="form-select" name="status-jemaat" id="status-jemaat" wire:model="flag_active">
                                            <option value="">Pilih Status Aktif</option>
                                            <option value="Y">Active</option>
                                            <option value="N">Inactive</option>
                                        </select>
                                    </div>
                                    @error('flag_active') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="nama-jemaat">Nama Jemaat <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <span id="nama-jemaat2" class="input-group-text"><i class="bx bx-buildings"></i></span>
                                <input wire:model="nama_jemaat" type="text" id="nama-jemaat" class="form-control" placeholder="Masukkan Nama Jabatan" />
                            </div>
                            @error('nama_jemaat') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="alamat-jemaat">Alamat Jemaat <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <span id="alamat-jemaat2" class="input-group-text"><i class='bx bx-map-alt'></i></span>
                                <textarea wire:model="alamat" id="alamat-jemaat" class="form-control" placeholder="Masukkan Alamat Jemaat"></textarea>
                            </div>
                            @error('alamat') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="image-jemaat">Gambar Jemaat</label>
                            <div class="input-group input-group-merge">
                                <span id="image-jemaat2" class="input-group-text"><i class='bx bx-image-add' ></i></span>
                                <input class="form-control" type="file" id="image-jemaat" wire:model="newImage" />
                            </div>
                            <div>
                                @if ($newImage)
                                    <img class="mt-2" src="{{ $newImage->temporaryUrl() }}" height="130">
                                @else
                                    @if ($image)
                                        <img class="mt-2" src="{{ asset('assets/img/jemaats') }}/{{ $image }}" height="130">
                                    @else
                                        <div class="mt-2">
                                            <img src="{{ asset('assets/img/noImageJemaat.png') }}" alt="Logo" height="130">
                                            <div style="font-size: 16px; font-style:italic">No Image</div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                            <div wire:loading wire:target="newImage">Uploading...</div>
                            @error('newImage') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <span style="font-style: italic; font-size:12px">Kolom dengan tanda bintang merah <span class="text-danger">(*)</span> wajib diisi</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal" wire:click="resetFromAddJemaat">
                            Close
                        </button>
                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Delete -->
    <div wire:ignore.self class="modal fade" id="modal-fromDelete-jemaat" tabindex="-1" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class='bx bx-info-circle mb-2' style="color:lightblue; font-size: 100px"></i>
                    <h4>Konfirmasi Delete</h4>
                    <span>Yakin ingin menghapus jemaat?</span>
                    <div class="mt-3">
                        <form action="" wire:submit.prevent="destroyJemaat">
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
        $('#modal-fromAdd-jemaat').modal('hide');
        $('#modal-fromDelete-jemaat').modal('hide');
        $('#modal-fromUpdate-jemaat').modal('hide');
    });
</script>