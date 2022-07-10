<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Jemaat;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class JemaatComponent extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $image, $kode_jemaat, $nama_jemaat, $alamat, $flag_active, $jemaat_id, $newImage;
    public $search = '';

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'image' => 'nullable|mimes:jpeg,jpg,png',
            'kode_jemaat' => 'required|unique:jemaats',
            'nama_jemaat' => 'required',
            'alamat' => 'required',
            'flag_active' => 'required',
        ]);
    }
    public function resetFromAddJemaat()
    {
        $this->image = null;
        $this->kode_jemaat = null;
        $this->nama_jemaat = null;
        $this->alamat = null;
        $this->flag_active = null;
        $this->newImage = null;
    }
    
    public function storeJemaatBaru()
    {
        $this->validate([
            'image' => 'nullable|mimes:jpeg,jpg,png',
            'kode_jemaat' => 'required|unique:jemaats',
            'nama_jemaat' => 'required',
            'alamat' => 'required',
            'flag_active' => 'required',
        ]);
        $jemaat = new Jemaat();
        if($this->image){
            $imagename = Carbon::now()->timestamp. '.' .$this->image->extension();
            $this->image->storeAs('jemaats', $imagename);
            $jemaat->image = $imagename;
        }
        $jemaat->kode_jemaat = $this->kode_jemaat;
        $jemaat->nama_jemaat = $this->nama_jemaat;
        $jemaat->alamat = $this->alamat;
        $jemaat->flag_active = $this->flag_active;
        $jemaat->save();

        $this->resetFromAddJemaat();
        $this->dispatchBrowserEvent('close-form-modal');
        session()->flash('msgJemaat', 'Jemaat baru berhasil ditambahkan!');
    }
    
    public function editJemaat(int $jemaat_id)
    {
        $jemaat = Jemaat::find($jemaat_id);
        if($jemaat){
            $this->jemaat_id = $jemaat->id;
            $this->image = $jemaat->image;
            $this->kode_jemaat = $jemaat->kode_jemaat;
            $this->nama_jemaat = $jemaat->nama_jemaat;
            $this->alamat = $jemaat->alamat;
            $this->flag_active = $jemaat->flag_active;
        }else{
            return redirect()->route('all.jemaat');
        }
    }
    public function updateJemaat()
    {
        $this->validate([
            'newImage' => 'nullable|mimes:jpeg,jpg,png',
            'kode_jemaat' => 'required',
            'nama_jemaat' => 'required',
            'alamat' => 'required',
            'flag_active' => 'required',
        ]);

        $jemaat = Jemaat::find($this->jemaat_id);
        if($this->newImage){
            Storage::delete('jemaats/' . $this->image);
            $imagename = Carbon::now()->timestamp. '.' .$this->newImage->extension();
            $this->newImage->storeAs('jemaats', $imagename);
            $jemaat->image = $imagename;
        }
        $jemaat->kode_jemaat = $this->kode_jemaat;
        $jemaat->nama_jemaat = $this->nama_jemaat;
        $jemaat->alamat = $this->alamat;
        $jemaat->flag_active = $this->flag_active;
        $jemaat->save();
        
        $this->resetFromAddJemaat();
        $this->dispatchBrowserEvent('close-form-modal');
        session()->flash('msgJemaat', 'Jemaat telah berhasil diperbaharui!');
    }
    
    public function deleteJemaat(int $jemaat_id)
    {
        $this->jemaat_id = $jemaat_id;
    }
    public function destroyJemaat()
    {
        Jemaat::find($this->jemaat_id)->delete();

        $this->resetFromAddJemaat();
        $this->dispatchBrowserEvent('close-form-modal');
        session()->flash('msgJemaat', 'Jemaat telah berhasil dihapus!');
    }

    public function activeJemaat(int $jemaat_id)
    {
        $jemaat = Jemaat::find($jemaat_id);
        $jemaat->flag_active = "Y";
        $jemaat->save();
        session()->flash('msgJemaat', 'Jemaat telah berhasil diaktifkan!');
    }
    public function inactiveJemaat(int $jemaat_id)
    {
        $jemaat = Jemaat::find($jemaat_id);
        $jemaat->flag_active = "N";
        $jemaat->save();
        session()->flash('msgJemaat', 'Jemaat telah berhasil dinonaktifkan!');
    }

    public function render()
    {
        $jemaats = Jemaat::where('nama_jemaat', 'like', '%'.$this->search.'%')->orderBy('flag_active', 'ASC')->paginate(10);
        return view('livewire.jemaat-component', ['jemaats' => $jemaats])->layout('layouts.base');
    }
}
