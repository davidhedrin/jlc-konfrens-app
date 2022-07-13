<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\FixedAsset;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ConvertPdfAssetComponent extends Component
{
    public function exportPdfAsset(int $assetId)
    {
        $user = User::find(Auth::user()->id);
        $findAssetDetail = FixedAsset::find($assetId);

        if($user->user_type == "ADM"){
            $pdf = Pdf::loadView('livewire.convert-pdf-asset-component', ['findAssetDetail' => $findAssetDetail]);
            $pdf->setPaper('A4', 'landscape')->setWarnings(false);
            return $pdf->stream('Asset'. $findAssetDetail->id .'.pdf');
        }else{
            if($user->jemaat_id == $findAssetDetail->jemaat_id){
                $pdf = Pdf::loadView('livewire.convert-pdf-asset-component', ['findAssetDetail' => $findAssetDetail]);
                $pdf->setPaper('A4', 'landscape')->setWarnings(false);
                return $pdf->stream('Asset'. $findAssetDetail->id .'.pdf');
            }else{
                session()->flush();
                session()->flash('fixedAssetPdfDenied', 'Ops... Telah terjadi kesalahan! Document yang anda minta bukan milik jemaat anda. Pastikan memilih document yang benar.');
                return redirect()->route('login');
            }
        }
    }
    // public function render()
    // {
    //     return view('livewire.convert-pdf-asset-component');
    // }
}
