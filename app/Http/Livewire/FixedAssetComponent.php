<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\FixedAsset;
use App\Models\Jemaat;
use App\Models\JenisFixedAsset;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FixedAssetComponent extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $search = '', $selectJenis = '';
    public $jemaat_id, $jenis_fixed_id, $status_kepemilikan;
    public $terbit_oleh, $no_imb, $no_sertifikat, $atas_nama;
    public $luas_tanah, $nama_bangunan, $posisi_surat, $pihak_ke3;
    public $manfaat_untuk, $lok_fisik_bangunan, $ket_sertifikat;
    public $tgl_sertifikat, $tgl_expired, $tgl_imb, $tgl_ke_konfrens;
    public $tgl_mulai_kerjasama, $tgl_akhir_kerjasama;
    public $sertifikat_file, $imb_file, $history_file, $doc_kerjasama;
    public $newsertifikat_file, $newimb_file, $newhistory_file, $newdoc_kerjasama;
    public $flag_active;

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

            'newsertifikat_file' => 'nullable|mimes:jpeg,jpg,pdf',
            'newimb_file' => 'nullable|mimes:jpeg,jpg,pdf',
            'newhistory_file' => 'nullable|mimes:jpeg,jpg,pdf',
            'newdoc_kerjasama' => 'nullable|mimes:jpeg,jpg,pdf',
        ]);
    }
    public function resetFormAddAsset()
    {
        $this->jemaat_id = null;
        $this->jenis_fixed_id = null;
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
        $this->flag_active = null;
        $this->sertifikat_file = null;
        $this->imb_file = null;
        $this->history_file = null;
        $this->doc_kerjasama = null;
        
        $this->newsertifikat_file = null;
        $this->newimb_file = null;
        $this->newhistory_file = null;
        $this->newdoc_kerjasama = null;
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

    public $id_asset;
    public function editDataFixedAsset(int $asset_id)
    {
        $asset = FixedAsset::find($asset_id);
        if($asset){
            $this->id_asset = $asset->id;
            $this->jemaat_id = $asset->jemaat_id;
            $this->jenis_fixed_id = $asset->jenis_fixed_id;
            $this->status_kepemilikan = $asset->status_kepemilikan;
            $this->terbit_oleh = $asset->terbit_oleh;
            $this->no_imb = $asset->no_imb;
            $this->no_sertifikat = $asset->no_sertifikat;
            $this->atas_nama = $asset->atas_nama;
            $this->luas_tanah = $asset->luas_tanah;
            $this->nama_bangunan = $asset->nama_bangunan;
            $this->posisi_surat = $asset->posisi_surat;
            $this->pihak_ke3 = $asset->pihak_ke3;
            $this->manfaat_untuk = $asset->manfaat_untuk;
            $this->lok_fisik_bangunan = $asset->lok_fisik_bangunan;
            $this->ket_sertifikat = $asset->ket_sertifikat;
            $this->tgl_sertifikat = $asset->tgl_sertifikat;
            $this->tgl_expired = $asset->tgl_expired;
            $this->tgl_imb = $asset->tgl_imb;
            $this->tgl_ke_konfrens = $asset->tgl_ke_konfrens;
            $this->tgl_mulai_kerjasama = $asset->tgl_mulai_kerjasama;
            $this->tgl_akhir_kerjasama = $asset->tgl_akhir_kerjasama;
            $this->flag_active = $asset->flag_active;

            $this->sertifikat_file = $asset->sertifikat_file;
            $this->imb_file = $asset->imb_file;
            $this->history_file = $asset->history_file;
            $this->doc_kerjasama = $asset->doc_kerjasama;
        }
    }
    public function updateDataEditAsset()
    {
        $this->validate([
            'no_sertifikat' => 'required',
            'atas_nama' => 'required',
            'jenis_fixed_id' => 'required',
            'jemaat_id' => 'required',
            'newsertifikat_file' => 'nullable|mimes:jpeg,jpg,pdf',
            'newimb_file' => 'nullable|mimes:jpeg,jpg,pdf',
            'newhistory_file' => 'nullable|mimes:jpeg,jpg,pdf',
            'newdoc_kerjasama' => 'nullable|mimes:jpeg,jpg,pdf',
        ]);

        $asset = FixedAsset::find($this->id_asset);
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
        
        if($this->newsertifikat_file){
            Storage::delete('fixedAssets/' . $this->sertifikat_file);
            $sertifikat_file_name = Carbon::now()->timestamp. '.' .$this->newsertifikat_file->extension();
            $this->newsertifikat_file->storeAs('fixedAssets', $sertifikat_file_name);
            $asset->sertifikat_file = $sertifikat_file_name;
        }
        if($this->newimb_file){
            Storage::delete('fixedAssets/' . $this->imb_file);
            $imb_file_name = Carbon::now()->timestamp. '.' .$this->newimb_file->extension();
            $this->newimb_file->storeAs('fixedAssets', $imb_file_name);
            $asset->imb_file = $imb_file_name;
        }
        if($this->newhistory_file){
            Storage::delete('fixedAssets/' . $this->history_file);
            $history_file_name = Carbon::now()->timestamp. '.' .$this->newhistory_file->extension();
            $this->newhistory_file->storeAs('fixedAssets', $history_file_name);
            $asset->history_file = $history_file_name;
        }
        if($this->newdoc_kerjasama){
            Storage::delete('fixedAssets/' . $this->doc_kerjasama);
            $doc_kerjasama_name = Carbon::now()->timestamp. '.' .$this->newdoc_kerjasama->extension();
            $this->newdoc_kerjasama->storeAs('fixedAssets', $doc_kerjasama_name);
            $asset->doc_kerjasama = $doc_kerjasama_name;
        }
        $asset->save();
        
        $this->resetFormAddAsset();
        $this->dispatchBrowserEvent('close-form-modal');
        session()->flash('msgAssets', 'Fixed asset telah berhasil diperbaharui!');
    }

    public function deleteFixedAsset(int $asset_id)
    {
        $this->id_asset = $asset_id;
    }
    public function destroyAsset()
    {
        $asset = FixedAsset::find($this->id_asset);
        Storage::delete('fixedAssets/' . $asset->sertifikat_file);
        Storage::delete('fixedAssets/' . $asset->imb_file);
        Storage::delete('fixedAssets/' . $asset->history_file);
        Storage::delete('fixedAssets/' . $asset->newdoc_kerjasama);
        $asset->delete();
        
        $this->resetFormAddAsset();
        $this->dispatchBrowserEvent('close-form-modal');
        session()->flash('msgAssets', 'Fixed asset telah berhasil dihapus!');
    }
    
    public function activeAsset(int $asset_id)
    {
        $asset = FixedAsset::find($asset_id);
        if(!$asset->flag_active){
            $asset->signer_asset = Auth::user()->name;
            $asset->active_sig_date = Carbon::now()->format('d F Y');
            $asset->active_sig_datetime = Carbon::now();
        }
        $asset->flag_active = "Y";
        $asset->save();
        session()->flash('msgAssets', 'User telah berhasil diaktifkan!');
    }
    public function inactiveAsset(int $asset_id)
    {
        $asset = FixedAsset::find($asset_id);
        $asset->flag_active = "N";
        $asset->save();
        session()->flash('msgAssets', 'User telah berhasil dinonaktifkan!');
    }

    public $findAssetDetail;
    public function detailDataFixedAsset(int $asset_id)
    {
        $this->findAssetDetail = FixedAsset::find($asset_id);
    }
    public function resetModelDetailAsset()
    {
        $this->findAssetDetail = null;
    }

    public function printFixedAsset(int $fixedAssId)
    {
        dd($fixedAssId);
    }

    public function render()
    {
        $jeins_fxs = JenisFixedAsset::all();
        $jemaats = Jemaat::all();
        $getUser = User::find(Auth::user()->id);

        if($getUser->user_type === "ADM"){
            $assets = FixedAsset::where('atas_nama', 'like', '%'.$this->search.'%')
            ->where('jenis_fixed_id', 'like', '%'.$this->selectJenis.'%')
            ->orderBy('flag_active', 'ASC')
            ->paginate(12);
        }else if($getUser->user_type === "USR"){
            $assets = FixedAsset::where('jemaat_id', $getUser->jemaat_id)
            ->where('atas_nama', 'like', '%'.$this->search.'%')
            ->where('jenis_fixed_id', 'like', '%'.$this->selectJenis.'%')
            ->orderBy('flag_active', 'ASC')
            ->paginate(12);
        }

        return view('livewire.fixed-asset-component', [
            'assets' => $assets,
            'jemaats' => $jemaats,
            'jeins_fxs' => $jeins_fxs,
        ])->layout('layouts.base');
    }
}
