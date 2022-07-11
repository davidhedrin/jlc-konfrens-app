<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Jemaat;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Hash;

class RegisterComponent extends Component
{
    public $user_id, $name, $email, $no_phone, $password, $conf_pass, $flag_active, $jemaat_id, $jabatan_id;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'user_id' => 'required',
            'name' => 'required',
            'email' => 'required|email:filter',
            'password' => 'required',
            'conf_pass' => 'required|same:password',
            'no_phone' => 'required|numeric',
            'jemaat_id' => 'required',
            'jabatan_id' => 'required',
        ]);
    }
    public function resetFormRegister()
    {
        $this->user_id = null;
        $this->name = null;
        $this->email = null;
        $this->password = null;
        $this->conf_pass = null;
        $this->no_phone = null;
        $this->flag_active = null;
        $this->jemaat_id = null;
        $this->jabatan_id = null;
    }

    public function generateUserId()
    {
        if($this->jemaat_id != "" && $this->jabatan_id != ""){
            $jemaat = Jemaat::find($this->jemaat_id);
            $jabatan = Jabatan::find($this->jabatan_id);
            $this->user_id = $jemaat->kode_jemaat.$jabatan->kode_jabatan;
        }else{
            $this->user_id = "";
        }
    }

    public function storeAddNewUser()
    {
        $this->validate([
            'user_id' => 'required',
            'name' => 'required',
            'email' => 'required|email:filter|unique:users',
            'password' => 'required',
            'conf_pass' => 'required|same:password',
            'no_phone' => 'required|numeric',
            'jemaat_id' => 'required',
            'jabatan_id' => 'required',
        ]);
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->no_phone = $this->no_phone;
        $user->user_type = "USR";
        $user->jemaat_id = $this->jemaat_id;
        $user->jabatan_id = $this->jabatan_id;
        $user->save();
        
        session()->flush();
        $this->resetFormRegister();
        session()->flash('msgUsersRegis', 'Holaa... Pendaftaran telah berhasil, mohon tunggu sampai admin menyetujui. Terimakasih!');
        return redirect()->route('login');
    }

    public function render()
    {
        $jemaats = Jemaat::all();
        $jabatans = Jabatan::all();
        return view(
            'livewire.register-component',
            [
                'jemaats' => $jemaats,
                'jabatans' => $jabatans,
            ]
        )->layout('layouts.guest');
    }
}
