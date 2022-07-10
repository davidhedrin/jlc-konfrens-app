<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Hash;

class ProfileComponent extends Component
{
    public $user_id, $name, $email, $no_phone, $user_type, $flag_active, $password, $conf_password;
    public $idUser;
    public $oldPassword, $newPassword, $newConfirmPass, $setujuPassword;
    public $setujuDelete;

    public function mount()
    {
        $profile = User::find(Auth::user()->id);
        $this->idUser = $profile->id;
        $this->name = $profile->name;
        $this->email = $profile->email;
        $this->no_phone = $profile->no_phone;
    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'email' => 'required|email:filter',
            'no_phone' => 'required|numeric',
            'newPassword' => 'required',
            'newConfirmPass' => 'required|same:newPassword',
            'setujuPassword' => 'required',
            'setujuDelete' => 'required',
        ]);
    }

    public function updateDataUser()
    {
        $this->dispatchBrowserEvent('close-form-modal');
        $this->validate([
            'name' => 'required',
            'email' => 'required|email:filter',
            'no_phone' => 'required|numeric',
        ]);

        $throttleKey = $this->idUser. '|' .request()->ip();
        
        if(RateLimiter::tooManyAttempts($throttleKey, 5)){
            $seconds  = RateLimiter::availableIn($throttleKey);
            $this->dispatchBrowserEvent('close-form-modal');
            session()->flash('msgLimitRequest', 'Maaf, percobaan profile telah melewat batas! Coba lagi dalam waktu ');
            session()->flash('msgLimitSecRequest', $seconds);
        }else{
            RateLimiter::hit($throttleKey);
            $user = User::find($this->idUser);
            $user->name = $this->name;
            $user->email = $this->email;
            $user->no_phone = $this->no_phone;
            $user->save();
    
            $this->dispatchBrowserEvent('close-form-modal');
            session()->flash('msgUpdateUser', 'Data profile berhasil diperbaharui');
        }
    }

    public function fieldResetPassword()
    {
        $this->oldPassword = null;
        $this->newPassword = null;
        $this->newConfirmPass = null;
        $this->setujuPassword = null;
        $this->setujuDelete = null;
    }
    public function CheckFieldResetPass()
    {
        $this->validate([
            'newPassword' => 'required',
            'newConfirmPass' => 'required|same:newPassword',
            'setujuPassword' => 'required',
        ]);
        $this->dispatchBrowserEvent('open-form-modal');
    }
    public function updateNewPassword()
    {
        $this->dispatchBrowserEvent('close-form-modal');
        $throttleKey = $this->idUser. '|' .request()->ip();
        
        if(RateLimiter::tooManyAttempts($throttleKey, 5)){
            $seconds  = RateLimiter::availableIn($throttleKey);
            session()->flash('msgLimitRequest', 'Maaf, percobaan kata sandi telah melewat batas! Coba lagi dalam waktu ');
            session()->flash('msgLimitSecRequest', $seconds);
        }else{
            RateLimiter::hit($throttleKey);
            $user = User::find($this->idUser);
            if(Hash::check($this->oldPassword, $user->password)){
                $user->password = Hash::make($this->newPassword);
                $user->save();
                $this->fieldResetPassword();
                session()->flash('msgUpdateUser', 'Kata sandi baru berhasil diperbaharui');
            }else{
                $this->fieldResetPassword();
                session()->flash('msgWrongPass', 'Gagal mengubah! Kata sandi lama tidak cocok');
            }
        }
    }

    public function checkDeleteField()
    {
        $this->validate([
            'setujuDelete' => 'required',
        ]);
        $this->dispatchBrowserEvent('open-delete-modal');
    }
    public function confirmationDeleteAccount()
    {
        $this->dispatchBrowserEvent('close-form-modal');
        $user = User::find($this->idUser);
        if(Hash::check($this->oldPassword, $user->password)){
            $user->delete();
            session()->flush();
            session()->flash('msgDeleteUser', 'Terimakasih atas keputusannya. Akun telah berhasil dihapus permanent dari sistem.');
            return redirect()->route('login');
        }else{
            $this->setujuDelete = null;
            $this->oldPassword = null;
            session()->flash('msgWrongPass', 'Gagal mengubah! Kata sandi tidak cocok');
        }
    }

    public function render()
    {
        $profile = User::find(Auth::user()->id);
        return view('livewire.profile-component',[
            'profile' => $profile,
        ])->layout('layouts.base');
    }
}
