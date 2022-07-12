<div>
    @if(Session::has('msgAssets'))
    <div class="bs-toast toast fade show bg-success toast-placement-ex top-0 end-0"
        style="margin-top: 90px; margin-right: 25px" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Successfully!</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ Session::get('msgAssets') }}
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="card-header">
                    <div class="row gx-3 gy-2 align-items-center">
                        {{-- <div class="col-md-7">
                            <h5 class="mb-0">Tabel Fixed Assets:</h5>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" id="jenis_fixed_id" wire:model="selectJenis">
                                <option value="">Pilih Jenis</option>
                                @foreach ($jeins_fxs as $jfs)
                                <option value="{{ $jfs->id }}">{{ $jfs->nama_jenis_fixed_asset }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input wire:model="search" class="form-control" type="search" id="search-user" placeholder="Temukan User...">
                        </div>
                        <div class="col-md-1 text-end">
                            <button type="button" class="btn btn-success mr-3" data-bs-toggle="modal"
                                data-bs-target="#modal-addnew-assets">Tambah</button>
                        </div> --}}

                        <div class="col-md-{{ Auth::user()->user_type == "ADM" ? '7' : '8' }}">
                            <h5 class="mb-0">Tabel Fixed Assets:</h5>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" id="jenis_fixed_id"  wire:model="selectJenis">
                                <option value="">Pilih Jenis</option>
                                @foreach ($jeins_fxs as $jfs)
                                <option value="{{ $jfs->id }}">{{ $jfs->nama_jenis_fixed_asset }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input wire:model="search" class="form-control" type="search" id="search-user" placeholder="Temukan User...">
                        </div>
                        @if (Auth::user()->user_type == "ADM")
                        <div class="col-md-1 text-end">
                            <button type="button" class="btn btn-success mr-3" data-bs-toggle="modal"
                                data-bs-target="#modal-addnew-assets">Tambah</button>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="dataTableAsset">
                            <thead>
                                <tr>
                                    <th width="10"><strong>No</strong></th>
                                    <th><strong>Jenis Asset</strong></th>
                                    <th><strong>No Sertikat</strong></th>
                                    <th><strong>Atas Nama</strong></th>
                                    <th><strong>Terbit Oleh</strong></th>
                                    <th><strong>No IMB</strong></th>
                                    <th class="text-center"><strong>Status</strong></th>
                                    <th class="text-center" width="115"><strong>Actions</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($i = 1)
                                @forelse ($assets as $ast)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $ast->jenisAsset->nama_jenis_fixed_asset }}</td>
                                        <td>{{ $ast->no_sertifikat }}</td>
                                        <td>{{ $ast->atas_nama }}</td>
                                        <td>{{ $ast->terbit_oleh }}</td>
                                        <td>{{ $ast->no_imb }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <span class="badge bg-label-{{ $ast->flag_active == "Y" ? "success" : ($ast->flag_active == "N" ? "danger" : "warning") }}">{{ $ast->flag_active == "Y" ? "Active" : ($ast->flag_active == "N" ? "Inactive" : "Panding") }}</span>
                                                
                                                @if (Auth::user()->user_type == "ADM")
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                    <a class="dropdown-item text-success" href="javascript:void(0);" wire:click="activeAsset({{ $ast->id }})">Active</a>
                                                    <a class="dropdown-item text-danger" href="javascript:void(0);" wire:click="inactiveAsset({{ $ast->id }})">Inactive</a>
                                                    </div>
                                                </div>
                                                @endif
                                                
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @if (Auth::user()->user_type == "ADM")
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modal-detailUser-assets" wire:click="detailDataFixedAsset({{ $ast->id }})"><i class='bx bx-info-circle me-1'></i></a>
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modal-editData-assets" wire:click="editDataFixedAsset({{ $ast->id }})"><i class="bx bx-edit-alt me-1"></i></a>
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modal-delete-assets" wire:click="deleteFixedAsset({{ $ast->id }})"><i class="bx bx-trash"></i></a>
                                            @else
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modal-detailUser-assets" wire:click="detailDataFixedAsset({{ $ast->id }})"><i class='bx bx-info-circle'></i> Detail</a>
                                            @endif
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
                            {{ $assets->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Extra Large Modal -->
    <div wire:ignore.self  class="modal fade" id="modal-addnew-assets" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4">Tambah Fixed Asset</h5>
                    <button wire:click="resetFormAddAsset" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="stroreFixedAsset">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <label for="jemaat_id" class="form-label">Jemaat <span class="text-danger">*</span></label>
                                <select class="form-select" id="jemaat_id" wire:model="jemaat_id">
                                    <option value="">Pilih Jemaat</option>
                                    @foreach ($jemaats as $jem)
                                    <option value="{{ $jem->id }}">{{ $jem->nama_jemaat }}</option>
                                    @endforeach
                                </select>
                                @error('jemaat_id') <span class="text-danger">Kolom ini harus diisi</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="jenis_fixed_id" class="form-label">Jenis Fixed <span class="text-danger">*</span></label>
                                <select class="form-select" id="jenis_fixed_id" wire:model="jenis_fixed_id">
                                    <option value="">Pilih Jenis</option>
                                    @foreach ($jeins_fxs as $jfs)
                                    <option value="{{ $jfs->id }}">{{ $jfs->nama_jenis_fixed_asset }}</option>
                                    @endforeach
                                </select>
                                @error('jenis_fixed_id') <span class="text-danger">Kolom ini harus diisi</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="no_sertifikat" class="form-label">Nomor Sertikat <span class="text-danger">*</span></label>
                                <input wire:model="no_sertifikat" class="form-control" type="text" id="no_sertifikat" placeholder="Masukkan Nomor Sertikat">
                                @error('no_sertifikat') <span class="text-danger">Kolom ini harus diisi</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="atas_nama" class="form-label">Atas Nama <span class="text-danger">*</span></label>
                                <input wire:model="atas_nama" class="form-control" type="text" id="atas_nama" placeholder="Masukkan Atas Nama" />
                                @error('atas_nama') <span class="text-danger">Kolom ini harus diisi</span> @enderror
                            </div>
    
                            
                            <div class="col-md-3 mb-2">
                                <label for="status_pemilik" class="form-label">Status Pemilikan</label>
                                <select class="form-select" id="status_pemilik" wire:model="status_kepemilikan">
                                    <option value="">Status Surat/Pemilikan</option>
                                    <option value="Surat Hak Milik">Surat Hak Milik</option>
                                    <option value="Hak Guna Bangunan">Hak Guna Bangunan</option>
                                    <option value="Girik">Girik</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="terbit_oleh" class="form-label">Diterbitkan Oleh</label>
                                <input wire:model="terbit_oleh" class="form-control" type="text" id="terbit_oleh" placeholder="Diterbitkan Oleh">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="laur_tanah" class="form-label">Luas Tanah (M2)</label>
                                <input wire:model="luas_tanah" class="form-control" type="text" id="laur_tanah" placeholder="Masukkan Luar Tanah(m2)">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="nama_bangunan" class="form-label">Bangunan</label>
                                <input wire:model="nama_bangunan" class="form-control" type="text" id="nama_bangunan" placeholder="Masukkan Nama Bangunan" />
                            </div>


                            <div class="col-md-3 mb-2">
                                <label for="tanggal_sertif" class="col-form-label">Tanggal Sertifikat</label>
                                <input wire:model="tgl_sertifikat" class="form-control" type="date" id="tanggal_sertif" />
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="tanggal_expired" class="col-form-label">Tanggal Expired</label>
                                <input wire:model="tgl_expired" class="form-control" type="date" id="tanggal_expired" />
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="no_imb" class="form-label">Nomor IMB</label>
                                <input wire:model="no_imb" class="form-control" type="text" id="no_imb" placeholder="Masukkan Nomor IMB" />
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="tanggal_imb" class="col-form-label">Tanggal IMB</label>
                                <input wire:model="tgl_imb" class="form-control" type="date" id="tanggal_imb" />
                            </div>
    
                            
                            <div class="col-md-12 mb-2">
                                <label for="lokasi_fisi" class="form-label">Lokasi Fisi Bangunan</label>
                                <textarea wire:model="lok_fisik_bangunan" class="form-control" id="lokasi_fisi" placeholder="Masukkan Lokasi Fisik"></textarea>
                            </div>
    
                            
                            <div class="col-md-3 mb-2">
                                <label for="posisi_surat" class="form-label">Posisi Surat</label>
                                <select class="form-select" id="posisi_surat" wire:model="posisi_surat">
                                    <option value="">Pilih Posisi Surat</option>
                                    <option value="Kantor Konfrens">Kantor Konfrens</option>
                                    <option value="Jemaat Setempat">Jemaat Setempat</option>
                                    <option value="Lain-lainnya">Lain-lainnya</option>
                                    <option value="Tidak Diketahui">Tidak Diketahui</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="kerjasama_pihak" class="form-label">Kerjasama Pihak Ke 3</label>
                                <input wire:model="pihak_ke3" class="form-control" type="text" id="kerjasama_pihak" placeholder="Masukkan Pihak Ketiga" />
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="pemanfaatan_untuk" class="form-label">Pemanfaatan untuk</label>
                                <input wire:model="manfaat_untuk" class="form-control" type="text" id="pemanfaatan_untuk" placeholder="Masukkan Pemanfaatan Untuk" />
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="tgl_kekonfrens" class="col-form-label">Tgl Ke Konfrens</label>
                                <input wire:model="tgl_ke_konfrens" class="form-control" type="date" id="tgl_kekonfrens" />
                            </div>
    
                            
                            <div class="col-md-6 mb-2">
                                <label for="tgl_mulai_kerjasama" class="col-form-label">Tgl Mulai Kerjasama</label>
                                <input wire:model="tgl_mulai_kerjasama" class="form-control" type="date" id="tgl_mulai_kerjasama" />
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="tgl_akhir_kerjasama" class="col-form-label">Tgl Berakhir Kerjasama</label>
                                <input wire:model="tgl_akhir_kerjasama" class="form-control" type="date" id="tgl_akhir_kerjasama" />
                            </div>
    
                            
                            <div class="col-md-12 mb-2">
                                <label for="ket_sertifikat" class="form-label">Keterangan</label>
                                <textarea wire:model="ket_sertifikat" class="form-control" id="ket_sertifikat" placeholder="Masukkan Keterangan Sertifikat"></textarea>
                            </div>

                            <span class="mb-1 mt-1" style="font-style: italic">Supporting Dokumen (Valid hanya file yg bertipe PDF dan jpg saja). Kosongkan jika tidak ada Dokumen Lampiran</span>
                            
                            <div class="col-md-3 mb-2">
                                <label class="form-label" for="sertifikat_file">Sertifikat</label>
                                <input class="form-control" type="file" id="sertifikat_file" wire:model="sertifikat_file" />
                                @error('sertifikat_file') <span class="text-danger">Harus tipe pdf/jpg</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label" for="imb_file">IMB</label>
                                <input class="form-control" type="file" id="imb_file" wire:model="imb_file" />
                                @error('imb_file') <span class="text-danger">Harus tipe pdf/jpg</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label" for="history_file">History</label>
                                <input class="form-control" type="file" id="history_file" wire:model="history_file" />
                                @error('history_file') <span class="text-danger">Harus tipe pdf/jpg</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label" for="doc_kerjasama">Dok Kerjasama</label>
                                <input class="form-control" type="file" id="doc_kerjasama" wire:model="doc_kerjasama" />
                                @error('doc_kerjasama') <span class="text-danger">Harus tipe pdf/jpg</span> @enderror
                            </div>
                        </div>
                        <span style="font-style: italic; font-size:12px">Kolom dengan tanda bintang merah <span class="text-danger">(*)</span> wajib diisi</span>
                    </div>
                    <div class="modal-footer">
                        <button wire:click="resetFormAddAsset" type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Extra Large Modal -->
    <div wire:ignore.self  class="modal fade" id="modal-editData-assets" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="margin-right: 10px" id="exampleModalLabel4">Edit Fixed Asset</h5>
                    <span class="badge bg-label-{{ $flag_active == "Y" ? "success" : ($flag_active == "N" ? "danger" : "warning") }}">{{ $flag_active == "Y" ? "Active" : ($flag_active == "N" ? "Inactive" : "Panding") }}</span>
                    <button wire:click="resetFormAddAsset" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="updateDataEditAsset">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <label for="jemaat_id" class="form-label">Jemaat <span class="text-danger">*</span></label>
                                <select class="form-select" id="jemaat_id" wire:model="jemaat_id">
                                    <option value="">Pilih Jemaat</option>
                                    @foreach ($jemaats as $jem)
                                    <option value="{{ $jem->id }}">{{ $jem->nama_jemaat }}</option>
                                    @endforeach
                                </select>
                                @error('jemaat_id') <span class="text-danger">Kolom ini harus diisi</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="jenis_fixed_id" class="form-label">Jenis Fixed <span class="text-danger">*</span></label>
                                <select class="form-select" id="jenis_fixed_id" wire:model="jenis_fixed_id">
                                    <option value="">Pilih Jenis</option>
                                    @foreach ($jeins_fxs as $jfs)
                                    <option value="{{ $jfs->id }}">{{ $jfs->nama_jenis_fixed_asset }}</option>
                                    @endforeach
                                </select>
                                @error('jenis_fixed_id') <span class="text-danger">Kolom ini harus diisi</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="no_sertifikat" class="form-label">Nomor Sertikat <span class="text-danger">*</span></label>
                                <input wire:model="no_sertifikat" class="form-control" type="text" id="no_sertifikat" placeholder="Masukkan Nomor Sertikat">
                                @error('no_sertifikat') <span class="text-danger">Kolom ini harus diisi</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="atas_nama" class="form-label">Atas Nama <span class="text-danger">*</span></label>
                                <input wire:model="atas_nama" class="form-control" type="text" id="atas_nama" placeholder="Masukkan Atas Nama" />
                                @error('atas_nama') <span class="text-danger">Kolom ini harus diisi</span> @enderror
                            </div>
    
                            
                            <div class="col-md-3 mb-2">
                                <label for="status_pemilik" class="form-label">Status Pemilikan</label>
                                <select class="form-select" id="status_pemilik" wire:model="status_kepemilikan">
                                    <option value="">Status Surat/Pemilikan</option>
                                    <option value="Surat Hak Milik">Surat Hak Milik</option>
                                    <option value="Hak Guna Bangunan">Hak Guna Bangunan</option>
                                    <option value="Girik">Girik</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="terbit_oleh" class="form-label">Diterbitkan Oleh</label>
                                <input wire:model="terbit_oleh" class="form-control" type="text" id="terbit_oleh" placeholder="Diterbitkan Oleh">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="laur_tanah" class="form-label">Luas Tanah (M2)</label>
                                <input wire:model="luas_tanah" class="form-control" type="text" id="laur_tanah" placeholder="Masukkan Luar Tanah(m2)">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="nama_bangunan" class="form-label">Bangunan</label>
                                <input wire:model="nama_bangunan" class="form-control" type="text" id="nama_bangunan" placeholder="Masukkan Nama Bangunan" />
                            </div>


                            <div class="col-md-3 mb-2">
                                <label for="tanggal_sertif" class="col-form-label">Tanggal Sertifikat</label>
                                <input wire:model="tgl_sertifikat" class="form-control" type="date" id="tanggal_sertif" />
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="tanggal_expired" class="col-form-label">Tanggal Expired</label>
                                <input wire:model="tgl_expired" class="form-control" type="date" id="tanggal_expired" />
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="no_imb" class="form-label">Nomor IMB</label>
                                <input wire:model="no_imb" class="form-control" type="text" id="no_imb" placeholder="Masukkan Nomor IMB" />
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="tanggal_imb" class="col-form-label">Tanggal IMB</label>
                                <input wire:model="tgl_imb" class="form-control" type="date" id="tanggal_imb" />
                            </div>
    
                            
                            <div class="col-md-12 mb-2">
                                <label for="lokasi_fisi" class="form-label">Lokasi Fisi Bangunan</label>
                                <textarea wire:model="lok_fisik_bangunan" class="form-control" id="lokasi_fisi" placeholder="Masukkan Lokasi Fisik"></textarea>
                            </div>
    
                            
                            <div class="col-md-3 mb-2">
                                <label for="posisi_surat" class="form-label">Posisi Surat</label>
                                <select class="form-select" id="posisi_surat" wire:model="posisi_surat">
                                    <option value="">Pilih Posisi Surat</option>
                                    <option value="Kantor Konfrens">Kantor Konfrens</option>
                                    <option value="Jemaat Setempat">Jemaat Setempat</option>
                                    <option value="Lain-lainnya">Lain-lainnya</option>
                                    <option value="Tidak Diketahui">Tidak Diketahui</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="kerjasama_pihak" class="form-label">Kerjasama Pihak Ke 3</label>
                                <input wire:model="pihak_ke3" class="form-control" type="text" id="kerjasama_pihak" placeholder="Masukkan Pihak Ketiga" />
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="pemanfaatan_untuk" class="form-label">Pemanfaatan untuk</label>
                                <input wire:model="manfaat_untuk" class="form-control" type="text" id="pemanfaatan_untuk" placeholder="Masukkan Pemanfaatan Untuk" />
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="tgl_kekonfrens" class="col-form-label">Tgl Ke Konfrens</label>
                                <input wire:model="tgl_ke_konfrens" class="form-control" type="date" id="tgl_kekonfrens" />
                            </div>
    
                            
                            <div class="col-md-6 mb-2">
                                <label for="tgl_mulai_kerjasama" class="col-form-label">Tgl Mulai Kerjasama</label>
                                <input wire:model="tgl_mulai_kerjasama" class="form-control" type="date" id="tgl_mulai_kerjasama" />
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="tgl_akhir_kerjasama" class="col-form-label">Tgl Berakhir Kerjasama</label>
                                <input wire:model="tgl_akhir_kerjasama" class="form-control" type="date" id="tgl_akhir_kerjasama" />
                            </div>
    
                            
                            <div class="col-md-12 mb-2">
                                <label for="ket_sertifikat" class="form-label">Keterangan</label>
                                <textarea wire:model="ket_sertifikat" class="form-control" id="ket_sertifikat" placeholder="Masukkan Keterangan Sertifikat"></textarea>
                            </div>

                            <span class="mb-1 mt-1" style="font-style: italic">Supporting Dokumen (Valid hanya file yg bertipe PDF dan jpg saja). Kosongkan jika tidak ada Dokumen Lampiran</span>
                            
                            <div class="col-md-3 mb-2">
                                <label class="form-label" for="newsertifikat_file">Sertifikat</label>
                                <input class="form-control" type="file" id="newsertifikat_file" wire:model="newsertifikat_file" />
                                @if ($sertifikat_file)
                                    <span>{{ $sertifikat_file }}</span>
                                @endif
                                @error('newsertifikat_file') <span class="text-danger">Harus tipe pdf/jpg</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label" for="newimb_file">IMB</label>
                                <input class="form-control" type="file" id="newimb_file" wire:model="newimb_file" />
                                @if ($imb_file)
                                    <span>{{ $imb_file }}</span>
                                @endif
                                @error('newimb_file') <span class="text-danger">Harus tipe pdf/jpg</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label" for="newhistory_file">History</label>
                                <input class="form-control" type="file" id="newhistory_file" wire:model="newhistory_file" />
                                @if ($history_file)
                                    <span>{{ $history_file }}</span>
                                @endif
                                @error('newhistory_file') <span class="text-danger">Harus tipe pdf/jpg</span> @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label" for="newdoc_kerjasama">Dok Kerjasama</label>
                                <input class="form-control" type="file" id="newdoc_kerjasama" wire:model="newdoc_kerjasama" />
                                @if ($doc_kerjasama)
                                    <span>{{ $doc_kerjasama }}</span>
                                @endif
                                @error('newdoc_kerjasama') <span class="text-danger">Harus tipe pdf/jpg</span> @enderror
                            </div>
                        </div>
                        <span style="font-style: italic; font-size:12px">Kolom dengan tanda bintang merah <span class="text-danger">(*)</span> wajib diisi</span>
                    </div>
                    <div class="modal-footer">
                        <button wire:click="resetFormAddAsset" type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <a href="{{ route('asset.pdf', ['assetId' => $id_asset != null ? $id_asset : 0]) }}" type="button" class="btn btn-success" ><i class='bx bx-printer'></i> PDF</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Delete -->
    <div wire:ignore.self class="modal fade" id="modal-delete-assets" tabindex="-1" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class='bx bx-info-circle mb-2' style="color:lightblue; font-size: 100px"></i>
                    <h4>Konfirmasi Delete</h4>
                    <span>Yakin ingin menghapus asset?</span>
                    <div class="mt-3">
                        <form action="" wire:submit.prevent="destroyAsset">
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

    <!-- Modal Detail User -->
    <div wire:ignore.self  class="modal fade" id="modal-detailUser-assets" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="margin-right: 10px" id="exampleModalLabel4">Edit Fixed Asset</h5>
                    @if ($findAssetDetail)
                    <span class="badge bg-label-{{ $findAssetDetail->flag_active == "Y" ? "success" : ($findAssetDetail->flag_active == "N" ? "danger" : "warning") }}">{{ $findAssetDetail->flag_active == "Y" ? "Active" : ($findAssetDetail->flag_active == "N" ? "Inactive" : "Panding") }}</span>
                    @endif
                    <button wire:click="resetModelDetailAsset" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @if ($findAssetDetail)
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Jemaat <span class="text-danger">*</span></label>
                            <div><h5>{{ $findAssetDetail->jemaat_id != null ? $findAssetDetail->jemaat->nama_jemaat : "!" }}</h5></div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Jenis Fixed <span class="text-danger">*</span></label>
                            <div><h5>{{ $findAssetDetail->jenisAsset->nama_jenis_fixed_asset }}</h5></div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Nomor Sertikat <span class="text-danger">*</span></label>
                            <div><h5>{{ $findAssetDetail->no_sertifikat }}</h5></div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Atas Nama <span class="text-danger">*</span></label>
                            <div><h5>{{ $findAssetDetail->atas_nama }}</h5></div>
                        </div>

                        
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Status Pemilikan</label>
                            @if ($findAssetDetail->status_kepemilikan)
                            <div><h5>{{ $findAssetDetail->status_kepemilikan }}</h5></div>
                            @else
                            <div><h5>-</h5></div>
                            @endif
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Diterbitkan Oleh</label>
                            @if ($findAssetDetail->terbit_oleh)
                            <div><h5>{{ $findAssetDetail->terbit_oleh }}</h5></div>
                            @else
                            <div><h5>-</h5></div>
                            @endif
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Luas Tanah (M2)</label>
                            @if ($findAssetDetail->luas_tanah)
                            <div><h5>{{ $findAssetDetail->luas_tanah }}</h5></div>
                            @else
                            <div><h5>-</h5></div>
                            @endif
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Bangunan</label>
                            @if ($findAssetDetail->nama_bangunan)
                            <div><h5>{{ $findAssetDetail->nama_bangunan }}</h5></div>
                            @else
                            <div><h5>-</h5></div>
                            @endif
                        </div>


                        <div class="col-md-3 mb-2">
                            <label for="tanggal_sertif" class="col-form-label">Tanggal Sertifikat</label>
                            @if ($findAssetDetail->tgl_sertifikat)
                            <div><h5>{{ $findAssetDetail->tgl_sertifikat }}</h5></div>
                            @else
                            <div><h5>-</h5></div>
                            @endif
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="tanggal_expired" class="col-form-label">Tanggal Expired</label>
                            @if ($findAssetDetail->tgl_expired)
                            <div><h5>{{ $findAssetDetail->tgl_expired }}</h5></div>
                            @else
                            <div><h5>-</h5></div>
                            @endif
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="no_imb" class="form-label">Nomor IMB</label>
                            @if ($findAssetDetail->no_imb)
                            <div><h5>{{ $findAssetDetail->no_imb }}</h5></div>
                            @else
                            <div><h5>-</h5></div>
                            @endif
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="tanggal_imb" class="col-form-label">Tanggal IMB</label>
                            @if ($findAssetDetail->tgl_imb)
                            <div><h5>{{ $findAssetDetail->tgl_imb }}</h5></div>
                            @else
                            <div><h5>-</h5></div>
                            @endif
                        </div>

                        
                        <div class="col-md-12 mb-2">
                            <label for="lokasi_fisi" class="form-label">Lokasi Fisi Bangunan</label>
                            @if ($findAssetDetail->lok_fisik_bangunan)
                            <div><h5>{{ $findAssetDetail->lok_fisik_bangunan }}</h5></div>
                            @else
                            <div><h5>-</h5></div>
                            @endif
                        </div>

                        
                        <div class="col-md-3 mb-2">
                            <label for="posisi_surat" class="form-label">Posisi Surat</label>
                            @if ($findAssetDetail->posisi_surat)
                            <div><h5>{{ $findAssetDetail->posisi_surat }}</h5></div>
                            @else
                            <div><h5>-</h5></div>
                            @endif
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="kerjasama_pihak" class="form-label">Kerjasama Pihak Ke 3</label>
                            @if ($findAssetDetail->pihak_ke3)
                            <div><h5>{{ $findAssetDetail->pihak_ke3 }}</h5></div>
                            @else
                            <div><h5>-</h5></div>
                            @endif
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="pemanfaatan_untuk" class="form-label">Pemanfaatan untuk</label>
                            @if ($findAssetDetail->manfaat_untuk)
                            <div><h5>{{ $findAssetDetail->manfaat_untuk }}</h5></div>
                            @else
                            <div><h5>-</h5></div>
                            @endif
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="tgl_kekonfrens" class="col-form-label">Tgl Ke Konfrens</label>
                            @if ($findAssetDetail->tgl_ke_konfrens)
                            <div><h5>{{ $findAssetDetail->tgl_ke_konfrens }}</h5></div>
                            @else
                            <div><h5>-</h5></div>
                            @endif
                        </div>

                        
                        <div class="col-md-6 mb-2">
                            <label for="tgl_mulai_kerjasama" class="col-form-label">Tgl Mulai Kerjasama</label>
                            @if ($findAssetDetail->tgl_mulai_kerjasama)
                            <div><h5>{{ $findAssetDetail->tgl_mulai_kerjasama }}</h5></div>
                            @else
                            <div><h5>-</h5></div>
                            @endif
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="tgl_akhir_kerjasama" class="col-form-label">Tgl Berakhir Kerjasama</label>
                            @if ($findAssetDetail->tgl_akhir_kerjasama)
                            <div><h5>{{ $findAssetDetail->tgl_akhir_kerjasama }}</h5></div>
                            @else
                            <div><h5>-</h5></div>
                            @endif
                        </div>

                        
                        <div class="col-md-12 mb-2">
                            <label for="ket_sertifikat" class="form-label">Keterangan</label>
                            @if ($findAssetDetail->ket_sertifikat)
                            <div><h5>{{ $findAssetDetail->ket_sertifikat }}</h5></div>
                            @else
                            <div><h5>-</h5></div>
                            @endif
                        </div>

                        <span class="mb-1 mt-1" style="font-style: italic">Supporting Dokumen (Valid hanya file yg bertipe PDF dan jpg saja). Kosongkan jika tidak ada Dokumen Lampiran</span>
                        
                        <div class="col-md-3 mb-2">
                            <label class="form-label" for="newsertifikat_file">Sertifikat</label>
                            @if ($findAssetDetail->sertifikat_file)
                            <div><h5>{{ $findAssetDetail->sertifikat_file }}</h5></div>
                            @else
                            <div><h5>-</h5></div>
                            @endif
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label" for="newimb_file">IMB</label>
                            @if ($findAssetDetail->imb_file)
                            <div><h5>{{ $findAssetDetail->imb_file }}</h5></div>
                            @else
                            <div><h5>-</h5></div>
                            @endif
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label" for="newhistory_file">History</label>
                            @if ($findAssetDetail->history_file)
                            <div><h5>{{ $findAssetDetail->history_file }}</h5></div>
                            @else
                            <div><h5>-</h5></div>
                            @endif
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label" for="newdoc_kerjasama">Dok Kerjasama</label>
                            @if ($findAssetDetail->doc_kerjasama)
                            <div><h5>{{ $findAssetDetail->doc_kerjasama }}</h5></div>
                            @else
                            <div><h5>-</h5></div>
                            @endif
                        </div>
                    </div>
                </div>
                @else
                <div class="modal-body d-flex justify-content-center">
                    <table>
                      <tbody>
                        <tr>
                          <td>
                            <div class="spinner-border text-dark" role="status">
                              <span class="visually-hidden">Loading...</span>
                            </div>
                          </td>
                          <td>
                            <span style="margin-left: 10px">Mohon tunggu...</span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                </div>
                @endif
                <div class="modal-footer">
                    <button wire:click="resetModelDetailAsset" type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    
                    @if (Auth::user()->user_type == "ADM")
                        @if ($findAssetDetail)
                        <a href="{{ route('asset.pdf', ['assetId' => $findAssetDetail->id]) }}" type="button" class="btn btn-success" ><i class='bx bx-printer'></i> PDF</a>
                        @endif
                    @else    
                        @if ($findAssetDetail && $findAssetDetail->flag_active == "Y")
                        <a href="{{ route('asset.pdf', ['assetId' => $findAssetDetail->id]) }}" type="button" class="btn btn-success" ><i class='bx bx-printer'></i> PDF</a>
                        @elseif ($findAssetDetail && $findAssetDetail->flag_active == "N")
                        <button type="button" class="btn btn-secondary" disabled><i class='bx bx-printer'></i> PDF</button>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    window.addEventListener('close-form-modal', event => {
        $('#modal-addnew-assets').modal('hide');
        $('#modal-delete-assets').modal('hide');
        $('#modal-editData-assets').modal('hide');
    });
</script>