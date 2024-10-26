<?php

namespace App\Livewire;
use App\Models\Transaksi;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\Mobil;

class LihatTransaksi extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[On('lihat-Transaksi')]
    public function render()
    {
        $data['transaksi'] = Transaksi::paginate(10);
        return view('livewire.lihat-transaksi', $data);
    }

    public function proses($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->update([
            'status' => 'PROSES'
        ]);
        session()->flash('success', 'Berhasil Proses Data');
    }

    public function selesai($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->update([
            'status' => 'SELESAI'
        ]);
        session()->flash('success', 'Berhasil Proses Data');
    }

    public function hapus($id)
    {
        $transaksi = Transaksi::find($id);

        if ($transaksi && $transaksi->status == 'SELESAI') {
            $transaksi->delete();
            session()->flash('success', 'Data transaksi berhasil dihapus');
        } else {
            session()->flash('error', 'Hanya transaksi dengan status SELESAI yang bisa dihapus');
        }
    }
}
