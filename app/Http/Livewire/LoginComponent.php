<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;

class LoginComponent extends Component
{
    public $email, $password, $remember;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'email' => 'required',
            'password' => 'required',
        ]);
    }

    public function checkUserLogin()
    {
        $this->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $this->email)->first();
        $throttleKey = strtolower($this->email) . '|' . request()->ip();

        if(RateLimiter::tooManyAttempts($throttleKey, 5)){
            $seconds  = RateLimiter::availableIn($throttleKey);
            session()->flash('msgLimitRequest', 'Maaf, percobaan login telah melewat batas! Coba lagi dalam waktu ');
            session()->flash('msgLimitSecRequest', $seconds);
            return redirect()->route('login');
        }

        // if(!Auth::attempt($this->only(['email', 'password']), $this->remember)){
        //     RateLimiter::hit($throttleKey);
        //     session()->flash('msgSalahEmailPw', 'Maaf, email atau password yang anda masukkan tidak terdaftar!');
        //     return redirect()->route('login');
        // }

        if($user){
            if(Hash::check($this->password, $user->password)){
                RateLimiter::hit($throttleKey);
                if($user->flag_active === "Y"){
                    Auth::attempt($this->only(['email', 'password']), $this->remember);
                }else if($user->flag_active === "N"){
                    session()->flash('msgFlagN', 'Ops... Akun anda telah di Non-aktifkan, Hubungi admin. Terimakasih!');
                    return redirect()->route('login');
                }else if($user->flag_active === null){
                    session()->flash('msgFlagNull', 'Maaf, Akun anda belum disetujui, Hubungi admin. Terimakasih!');
                    return redirect()->route('login');
                }
            }else{
                RateLimiter::hit($throttleKey);
                session()->flash('msgPassWrong', 'Maaf, password yang anda masukkan tidak sesuai!');
                return redirect()->route('login');
            }
        }else{
            RateLimiter::hit($throttleKey);
            session()->flash('msgUserNotFound', 'Maaf, email atau password yang anda masukkan tidak terdaftar!');
            return redirect()->route('login');
        }
    
        return redirect()->to('/');
    }

    public function render()
    {
        return view('livewire.login-component')->layout('layouts.guest');
    }
}
