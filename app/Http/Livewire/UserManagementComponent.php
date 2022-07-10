<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Jemaat;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

class UserManagementComponent extends Component
{
    use WithPagination;
    public $search = '';
    public $user_id, $name, $email, $no_phone, $user_type, $flag_active, $password, $conf_password;
    public $newPassword, $newconf_password;
    public $selectJemaat, $selectJabatan;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'selectJemaat' => 'required',
            'selectJabatan' => 'required',
            'name' => 'required',
            'email' => 'required|email:filter|unique:users',
            'no_phone' => 'required|numeric',
            'user_type' => 'required',
            'password' => 'required',
            'conf_password' => 'required|same:password',
            'newPassword' => 'required',
            'newconf_password' => 'required|same:newPassword'
        ]);
    }
    public function resetFromAddUsers()
    {
        $this->user_id = null;
        $this->name = null;
        $this->email = null;
        $this->no_phone = null;
        $this->user_type = null;
        $this->password = null;
        $this->flag_active = null;
        $this->selectJemaat = null;
        $this->selectJabatan = null;
    }
    public function generateUserId()
    {
        if($this->selectJemaat != "" && $this->selectJabatan != ""){
            $jemaat = Jemaat::find($this->selectJemaat);
            $jabatan = Jabatan::find($this->selectJabatan);
            $this->user_id = $jemaat->kode_jemaat.$jabatan->kode_jabatan;
        }else{
            $this->user_id = "";
        }
    }

    public function storeNewUser()
    {
        $this->validate([
            'selectJemaat' => 'required',
            'selectJabatan' => 'required',
            'name' => 'required',
            'email' => 'required|email:filter|unique:users',
            'no_phone' => 'required|numeric',
            'user_type' => 'required',
            'password' => 'required',
            'conf_password' => 'required|same:password'
        ]);
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->no_phone = $this->no_phone;
        $user->user_type = $this->user_type;
        $user->flag_active = $this->flag_active;
        $user->password = Hash::make($this->password);
        $user->jemaat_id = $this->selectJemaat;
        $user->jabatan_id = $this->selectJabatan;
        $user->save();

        $this->resetFromAddUsers();
        $this->dispatchBrowserEvent('close-form-modal');
        session()->flash('msgUsers', 'User baru berhasil ditambahkan!');
    }
    
    public $id_user;
    public function editDataUser(int $user_id){
        $user = User::find($user_id);
        if($user){
            $this->id_user = $user->id;
            $this->selectJemaat = $user->jemaat_id;
            $this->selectJabatan = $user->jabatan_id;
            $this->user_id = $user->jemaat->kode_jemaat . $user->jabatan->kode_jabatan;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->no_phone = $user->no_phone;
            $this->user_type = $user->user_type;
            $this->flag_active = $user->flag_active;
            $this->password = $user->password;
            $this->conf_password = $user->password;
            $this->newPassword = $user->password;
            $this->newconf_password = $user->password;
        }
    }
    public function updateDataUser(){
        $this->validate([
            'selectJemaat' => 'required',
            'selectJabatan' => 'required',
            'name' => 'required',
            'email' => 'required|email:filter',
            'no_phone' => 'required',
            'user_type' => 'required',
            'newPassword' => 'required',
            'newconf_password' => 'required|same:newPassword'
        ]);
        $user = User::find($this->id_user);
        $user->name = $this->name;
        $user->email = $this->email;
        $user->no_phone = $this->no_phone;
        $user->user_type = $this->user_type;
        $user->flag_active = $this->flag_active;
        $user->jemaat_id = $this->selectJemaat;
        $user->jabatan_id = $this->selectJabatan;
        if($user->password != $this->newPassword){
            $user->password = Hash::make($this->newPassword);
        }
        $user->save();

        $this->resetFromAddUsers();
        $this->dispatchBrowserEvent('close-form-modal');
        session()->flash('msgUsers', 'User telah berhasil diperbaharui!');
    }
    
    public function deleteJemaat(int $user_id)
    {
        $this->id_user = $user_id;
    }
    public function destroyUser()
    {
        $user = User::find($this->id_user)->delete();

        $this->resetFromAddUsers();
        $this->dispatchBrowserEvent('close-form-modal');
        session()->flash('msgUsers', 'User telah berhasil dihapus!');
    }
    
    public function activeUser(int $user_id)
    {
        $user = User::find($user_id);
        $user->flag_active = "Y";
        $user->save();
        session()->flash('msgUsers', 'User telah berhasil diaktifkan!');
    }
    public function inactiveUser(int $user_id)
    {
        $user = User::find($user_id);
        $user->flag_active = "N";
        $user->save();
        session()->flash('msgUsers', 'User telah berhasil dinonaktifkan!');
    }

    public function render()
    {
        $jabatans = Jabatan::all();
        $jemaat = Jemaat::all();
        $users = User::where('name', 'like', '%'.$this->search.'%')->orderBy('flag_active', 'ASC')->paginate(10);
        return view('livewire.user-management-component', [
            'users' => $users,
            'jabatans' => $jabatans,
            'jemaats' => $jemaat,
        ])->layout('layouts.base');
    }
}
