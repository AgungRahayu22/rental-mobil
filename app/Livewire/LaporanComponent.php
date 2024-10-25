<?php

namespace App\Livewire;
use App\Models\Transaksi;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Attributes\On;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanComponent extends Component
{
    use WithPagination,WithoutUrlPagination;

    public  $tanggal1,$tanggal2;

    #[On('lihat-Laporan')]
    public function render()
    {
        if($this->tanggal2!=""){
            $data['transaksi'] =Transaksi::where('status','SELESAI')->whereBetween('tgl_pesan',[$this->tanggal1,$this->tanggal2])->paginate(10);
        }
        else{
             $data['transaksi'] =Transaksi::where('status','SELESAI')->paginate(10);
        }

        return view('livewire.laporan-component', $data);
    }
    public function cari(){
        $this->dispatch('lihat-Laporan');
    }
    public function exportpdf(){
        if ($this->tanggal2!=""){
             $data['transaksi'] =Transaksi::where('status','SELESAI')->whereBetween('tgl_pesan',[$this->tanggal1,$this->tanggal2])->get();
         $pdf=Pdf::loadView('laporan.exportpdf', $data)->output();
         return response()->streamDownload(
            fn()=>print($pdf),"Laporan Transaksi". $this->tanggal1. ' s-d '. $this->tanggal2."pdf");
        }
        else{
             $data['transaksi'] =Transaksi::where('status','SELESAI')->get();
         $pdf=Pdf::loadView('laporan.exportpdf', $data)->output();
         return response()->streamDownload(
            fn()=>print($pdf),"Laporan Transaksi keseluruhan.pdf");
        };

    }
}
