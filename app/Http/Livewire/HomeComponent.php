<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\FixedAsset;
use App\Models\Jemaat;
use App\Models\User;
use App\Models\Jabatan;
use Carbon\Carbon;

class HomeComponent extends Component
{
    public function loadAllData()
    {
        $profile = User::find(Auth::user()->id);

        $users = User::all();
        $jemaats = Jemaat::all();
        $assets = FixedAsset::all();
        $jabatan = Jabatan::all();

        $asset1Week = FixedAsset::where('created_at','>=',Carbon::now()->subdays(6));
        $user1Week = User::where('created_at','>=',Carbon::now()->subdays(6));
        $jemaat1Week = Jemaat::where('created_at','>=',Carbon::now()->subdays(6));
        $jabatan1Week = Jabatan::where('created_at','>=',Carbon::now()->subdays(6));

        return [
            'profile' => $profile,

            'users' => $users,
            'jemaats' => $jemaats,
            'assets' => $assets,
            'jabatan' => $jabatan,
            
            'asset1Week' => $asset1Week,
            'user1Week' => $user1Week,
            'jemaat1Week' => $jemaat1Week,
            'jabatan1Week' => $jabatan1Week,
        ];
    }
    public function render()
    {
        $allDatas = $this->loadAllData();
        return view('livewire.home-component', $allDatas)->layout('layouts.base');
    }
}
