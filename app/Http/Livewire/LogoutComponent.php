<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LogoutComponent extends Component
{
    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login');
    }
    public function render()
    {
        $this->logout();
        return view('livewire.logout-component');
    }
}
