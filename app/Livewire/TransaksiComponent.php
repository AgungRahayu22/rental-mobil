<?php

namespace App\Livewire;

use App\Models\Mobil;
use App\Models\Transaksi;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Auth;

class TransaksiComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $addPage,$lihatPage = false;
    public $nama,$ponsel,$alamat,$lama,$tanggal,$mobil_id,$harga,$total;
    public function render()
    {
        $data['mobil'] =Mobil::paginate(5);
        return view('livewire.transaksi-component',$data);
    }
    public function create($id,$harga){
        $this->mobil_id = $id;
        $this->harga = $harga;
        $this->addPage = true;
    }
    public function hitung(){
        $lama = $this->lama;
        $harga = $this->harga;
        $this->total = $lama * $harga;
    }
    public function store(){
        $this->validate([
            'nama' => 'required',
            'ponsel' => 'required',
            'alamat' => 'required',
            'lama' => 'required',
            'tanggal' => 'required',
        ],[
            'nama.required' => 'Nama Tidak boleh kosong',
            'ponsel.required' => 'Nomor Ponsel Tidak boleh kosong',
            'alamat.required' => 'Alamat Tidak boleh kosong',
            'lama.required' => 'Lama Pesan Tidak boleh kosong',
            'tanggal.required' => 'Tanggal Tidak boleh kosong',
        ]);
        $cari = Transaksi::where('mobil_id',$this->mobil_id)->where('tgl_pesan',$this->tanggal)->where('status','!=','SELESAI')->count();
        if($cari == 1){
            session()->flash('error', 'Mobil sudah Sudah ada yang memesan!');
        }else{
            Transaksi::create([
                    'user_id' => Auth::user()->id,
                    'mobil_id' => $this->mobil_id,
                    'nama' => $this->nama,
                    'ponsel' => $this->ponsel,
                    'lama' => $this->lama,
                    'alamat' => $this->alamat,
                    'tgl_pesan' => $this->tanggal,
                    'total' => $this->total,
                    'status' => 'WAIT',
                ]);

                session()->flash('success', 'Transaksi Berhasil disimpan ');
        }
        $this->dispatch('lihat-transaksi');
        $this->reset();
    }
    public function lihat($id){
        $data['transaksi'] =Transaksi::paginate(10);
        return view('livewire.transaksi-component',$data);
}
}
