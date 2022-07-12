<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\FixedAsset;
use Barryvdh\DomPDF\Facade\Pdf;

class ConvertPdfAssetComponent extends Component
{
    public function exportPdfAsset(int $assetId)
    {
        $findAssetDetail = FixedAsset::find($assetId);
        $pdf = Pdf::loadView('livewire.convert-pdf-asset-component', ['findAssetDetail' => $findAssetDetail]);
        $pdf->setPaper('A4', 'landscape')->setWarnings(false);
        return $pdf->stream('invoice'. rand(1, 1000) .'.pdf');
    }
    // public function render()
    // {
    //     return view('livewire.convert-pdf-asset-component');
    // }
}
