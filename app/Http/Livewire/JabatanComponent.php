<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Jabatan;
use Livewire\WithPagination;

class JabatanComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $kode_jabatan, $nama_jabatan, $ket_jabatan, $jabatan_id;
    
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'kode_jabatan' => 'required|unique:jabatans',
            'nama_jabatan' => 'required',
        ]);
    }
    public function resetFromJabatan()
    {
        $this->kode_jabatan = null;
        $this->nama_jabatan = null;
        $this->ket_jabatan = null;
    }

    public function storeJabatan()
    {
        $this->validate([
            'kode_jabatan' => 'required|unique:jabatans',
            'nama_jabatan' => 'required',
        ]);
        $jabatan = new Jabatan();
        $jabatan->kode_jabatan = $this->kode_jabatan;
        $jabatan->nama_jabatan = $this->nama_jabatan;
        $jabatan->ket_jabatan = $this->ket_jabatan;
        $jabatan->save();

        $this->resetFromJabatan();
        $this->dispatchBrowserEvent('close-form-modal');
        session()->flash('msgJabatan', 'Jabatan baru berhasil ditambahkan!');
    }

    public function editJabatan(int $jabatan_id)
    {
        $jabatan = Jabatan::find($jabatan_id);
        if($jabatan){
            $this->jabatan_id = $jabatan->id;
            $this->kode_jabatan = $jabatan->kode_jabatan;
            $this->nama_jabatan = $jabatan->nama_jabatan;
            $this->ket_jabatan = $jabatan->ket_jabatan;
        }else{
            return redirect()->route('all.jabatan');
        }
    }
    public function updateJabatan()
    {
        $this->validate([
            'kode_jabatan' => 'required|unique:jabatans',
            'nama_jabatan' => 'required',
        ]);
        $jabatan = Jabatan::find($this->jabatan_id);
        $jabatan->kode_jabatan = $this->kode_jabatan;
        $jabatan->nama_jabatan = $this->nama_jabatan;
        $jabatan->ket_jabatan = $this->ket_jabatan;
        $jabatan->save();
        
        $this->resetFromJabatan();
        $this->dispatchBrowserEvent('close-form-modal');
        session()->flash('msgJabatan', 'Jabatan jemaat berhasil diperbaharui!');
    }
    
    public function deleteJabatan(int $jabatan_id)
    {
        $this->jabatan_id = $jabatan_id;
    }
    public function destroyJabatan()
    {
        Jabatan::find($this->jabatan_id)->delete();
        
        $this->jabatan_id = null;
        $this->dispatchBrowserEvent('close-form-modal');
        session()->flash('msgJabatan', 'Jabatan jemaat berhasil dihapus!');
    }

    public function render()
    {
        $jabatans = Jabatan::where('nama_jabatan', 'like', '%'.$this->search.'%')->paginate(10);
        $jabatanCards = Jabatan::paginate(10);
        return view('livewire.jabatan-component', [
            'jabatans' => $jabatans,
            'jabatanCards' => $jabatanCards,
        ])->layout('layouts.base');
    }
}
