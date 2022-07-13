<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\RateLimiter;

class VerificationComponent extends Component
{
    public function sendEmailVerify()
    {
        $user = Auth::user();
        $throttleKey = $user->email. '|' .request()->ip();
        
        if(RateLimiter::tooManyAttempts($throttleKey, 2)){
            $seconds  = RateLimiter::availableIn($throttleKey);

            $this->dispatchBrowserEvent('close-form-modal');
            session()->flash('msgEmailVerifyLimit', 'Maaf, percobaan kirim email telah berhasil, coba lagi dalam waktu');
            session()->flash('msgEmailSecLimit', $seconds);
        }else{
            RateLimiter::hit($throttleKey);
            event(new Registered($user));

            $this->dispatchBrowserEvent('close-form-modal');
            session()->flash('msgEmailVerify', 'Verifikasi Email berhasil dikirim! Periksa email anda dan verifikasi email.');
        }

    }

    public function render()
    {
        return view('livewire.auth.verification-component')->layout('layouts.guest');
    }
}
