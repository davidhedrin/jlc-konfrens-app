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
                <div class="card-header row">
                    <div class="col-md-6">
                        <h5 class="mb-0">Tabel Fixed Assets:</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-end">
                            <div style="margin-right: 10px">
                                <input wire:model="" class="form-control" style="width: 250px" type="search"
                                    id="search-user" placeholder="Temukan User...">
                            </div>
                            <div>
                                <button type="button" class="btn btn-success mr-3" data-bs-toggle="modal"
                                    data-bs-target="#modal-addnew-assets">Tambah</button>
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
                                    <th><strong>Jenis Asset</strong></th>
                                    <th><strong>No Sertikat</strong></th>
                                    <th><strong>Atas Nama</strong></th>
                                    <th><strong>Terbit Oleh</strong></th>
                                    <th><strong>No IMB</strong></th>
                                    <th class="text-center"><strong>Status</strong></th>
                                    <th class="text-center" width="80"><strong>Actions</strong></th>
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
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                    <a class="dropdown-item text-success" href="javascript:void(0);" wire:click="activeUser({{ $ast->id }})">Active</a>
                                                    <a class="dropdown-item text-danger" href="javascript:void(0);" wire:click="inactiveUser({{ $ast->id }})">Inactive</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modal-fromUpdate-user" wire:click="editDataUser({{ $ast->id }})"><i class="bx bx-edit-alt me-1"></i></a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modal-fromDelete-user" wire:click="deleteJemaat({{ $ast->id }})"><i class="bx bx-trash me-1"></i></a>
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
                            {{-- {{ $assets->links() }} --}}
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
                    <button wire.click="resetFormAddAsset" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                        <button wire.click="resetFormAddAsset" type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">    
    window.addEventListener('close-form-modal', event => {
        $('#modal-addnew-assets').modal('hide');
    });
</script>