<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Password;

class ForgotPasswordComponent extends Component
{
    public $email;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'email' => 'required|email:filter',
        ]);
    }
    public function sendLinkResetPass()
    {
        $this->validate([
            'email' => 'required|email:filter',
        ]);
        Password::sendResetLink(['email' => $this->email]);
        
        session()->flash('msgEmailVerify', 'Verifikasi Email berhasil dikirim! Periksa email anda dan verifikasi email.');
    }

    public function render()
    {
        return view('livewire.auth.forgot-password-component')->layout('layouts.guest');
    }
}
