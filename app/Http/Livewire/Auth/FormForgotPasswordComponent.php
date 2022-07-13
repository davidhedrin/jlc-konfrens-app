<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;

class FormForgotPasswordComponent extends Component
{
    public $token, $email;
    public $newPassword, $confNewPassword;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'newPassword' => 'required',
            'confNewPassword' => 'required|same:newPassword',
        ]);
    }

    public function mount(Request $request)
    {
        $this->token = $request->token;
        $this->email = $request->email;
    }

    public function saveNewPassword()
    {
        $this->validate([
            'newPassword' => 'required',
            'confNewPassword' => 'required|same:newPassword',
        ]);
        $user = User::where('email', $this->email)->first();
        $throttleKey = $this->email. '|' .request()->ip();

        if(RateLimiter::tooManyAttempts($throttleKey, 1)){
            session()->flash('msgLimitForgPass', 'Maaf, percobaan kata sandi baru telah melewati batas, coba beberapa saat lagi.');
            return redirect()->route('login');
        }else{
            RateLimiter::hit($throttleKey);
            if($user){
                $user->password = Hash::make($this->newPassword);
                $user->remember_token = $this->token;
                $user->save();
                
                event(new PasswordReset($user));
                session()->flash('msgVailedNewPassword', 'Atur ulang kata sandi telah berhasil, Silahkan lakukan login');
                session()->flash('msgVailedNewPasswordStatus', 'success');
                return redirect()->route('login');
            }else{
                session()->flash('msgVailedNewPassword', 'Terjadi kesalahan. Gagal mengatur ulang kata sandei, dikarenakan Email sudah tidak lagi terdaftar.');
                session()->flash('msgVailedNewPasswordStatus', 'info');
                return redirect()->route('login');
            }
        }
    }
    
    public function render()
    {
        return view('livewire.auth.form-forgot-password-component')->layout('layouts.guest');
    }
}
