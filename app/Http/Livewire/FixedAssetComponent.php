<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\FixedAsset;
use App\Models\Jemaat;
use App\Models\JenisFixedAsset;
use Carbon\Carbon;

class FixedAssetComponent extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $search = '';
    public $jemaat_id, $jenis_fixed_id, $status_kepemilikan;
    public $terbit_oleh, $no_imb, $no_sertifikat, $atas_nama;
    public $luas_tanah, $nama_bangunan, $posisi_surat, $pihak_ke3;
    public $manfaat_untuk, $lok_fisik_bangunan, $ket_sertifikat;
    public $tgl_sertifikat, $tgl_expired, $tgl_imb, $tgl_ke_konfrens;
    public $tgl_mulai_kerjasama, $tgl_akhir_kerjasama;
    public $sertifikat_file, $imb_file, $history_file, $doc_kerjasama;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'no_sertifikat' => 'required',
            'atas_nama' => 'required',
            'jenis_fixed_id' => 'required',
            'jemaat_id' => 'required',
            'sertifikat_file' => 'nullable|mimes:jpeg,jpg,pdf',
            'imb_file' => 'nullable|mimes:jpeg,jpg,pdf',
            'history_file' => 'nullable|mimes:jpeg,jpg,pdf',
            'doc_kerjasama' => 'nullable|mimes:jpeg,jpg,pdf',
        ]);
    }
    public function resetFormAddAsset()
    {
        $this->jemaat_id = null;
        $this->jenis_fixed = null;
        $this->status_kepemilikan = null;
        $this->terbit_oleh = null;
        $this->no_imb = null;
        $this->no_sertifikat = null;
        $this->atas_nama = null;
        $this->luas_tanah = null;
        $this->nama_bangunan = null;
        $this->posisi_surat = null;
        $this->pihak_ke3 = null;
        $this->manfaat_untuk = null;
        $this->lok_fisik_bangunan = null;
        $this->ket_sertifikat = null;
        $this->tgl_sertifikat = null;
        $this->tgl_expired = null;
        $this->tgl_imb = null;
        $this->tgl_ke_konfrens = null;
        $this->tgl_mulai_kerjasama = null;
        $this->tgl_akhir_kerjasama = null;
    }

    public function stroreFixedAsset()
    {
        $this->validate([
            'no_sertifikat' => 'required',
            'atas_nama' => 'required',
            'jenis_fixed_id' => 'required',
            'jemaat_id' => 'required',
            'sertifikat_file' => 'nullable|mimes:jpeg,jpg,pdf',
            'imb_file' => 'nullable|mimes:jpeg,jpg,pdf',
            'history_file' => 'nullable|mimes:jpeg,jpg,pdf',
            'doc_kerjasama' => 'nullable|mimes:jpeg,jpg,pdf',
        ]);

        $asset = new FixedAsset();
        $asset->jemaat_id = $this->jemaat_id;
        $asset->jenis_fixed_id = $this->jenis_fixed_id;
        $asset->status_kepemilikan = $this->status_kepemilikan;
        $asset->terbit_oleh = $this->terbit_oleh;
        $asset->no_imb = $this->no_imb;
        $asset->no_sertifikat = $this->no_sertifikat;
        $asset->atas_nama = $this->atas_nama;
        $asset->luas_tanah = $this->luas_tanah;
        $asset->nama_bangunan = $this->nama_bangunan;
        $asset->posisi_surat = $this->posisi_surat;
        $asset->pihak_ke3 = $this->pihak_ke3;
        $asset->manfaat_untuk = $this->manfaat_untuk;
        $asset->lok_fisik_bangunan = $this->lok_fisik_bangunan;
        $asset->ket_sertifikat = $this->ket_sertifikat;
        $asset->tgl_sertifikat = $this->tgl_sertifikat;
        $asset->tgl_expired = $this->tgl_expired;
        $asset->tgl_imb = $this->tgl_imb;
        $asset->tgl_ke_konfrens = $this->tgl_ke_konfrens;
        $asset->tgl_mulai_kerjasama = $this->tgl_mulai_kerjasama;
        $asset->tgl_akhir_kerjasama = $this->tgl_akhir_kerjasama;

        if($this->sertifikat_file){
            $sertifikat_file_name = Carbon::now()->timestamp. '.' .$this->sertifikat_file->extension();
            $this->sertifikat_file->storeAs('fixedAssets', $sertifikat_file_name);
            $asset->sertifikat_file = $sertifikat_file_name;
        }
        if($this->imb_file){
            $imb_file_name = Carbon::now()->timestamp. '.' .$this->imb_file->extension();
            $this->imb_file->storeAs('fixedAssets', $imb_file_name);
            $asset->imb_file = $imb_file_name;
        }
        if($this->history_file){
            $history_file_name = Carbon::now()->timestamp. '.' .$this->history_file->extension();
            $this->history_file->storeAs('fixedAssets', $history_file_name);
            $asset->history_file = $history_file_name;
        }
        if($this->doc_kerjasama){
            $doc_kerjasama_name = Carbon::now()->timestamp. '.' .$this->doc_kerjasama->extension();
            $this->doc_kerjasama->storeAs('fixedAssets', $doc_kerjasama_name);
            $asset->doc_kerjasama = $doc_kerjasama_name;
        }
        $asset->save();
        
        $this->resetFormAddAsset();
        $this->dispatchBrowserEvent('close-form-modal');
        session()->flash('msgAssets', 'Fixed asset baru berhasil ditambahkan!');
    }

    public function render()
    {
        $jeins_fxs = JenisFixedAsset::all();
        $assets = FixedAsset::paginate(12);
        $jemaats = Jemaat::all();
        return view('livewire.fixed-asset-component', [
            'assets' => $assets,
            'jemaats' => $jemaats,
            'jeins_fxs' => $jeins_fxs,
        ])->layout('layouts.base');
    }
}
