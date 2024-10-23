<?php

namespace App\Livewire;
use App\Models\Mobil;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Auth; // Tambahkan ini


class MobilComponent extends Component
{
    use WithPagination, WithoutUrlPagination, WithFileUploads;
    protected $paginationTheme = "bootstrap";
    public $addPage,$editPage=false;
    public $nopolisi,$merk,$jenis,$kapasitas,$harga,$foto,$id;
    public function render()
    {
        $data['mobil'] =Mobil::paginate(10);
        return view('livewire.mobil-component',$data);
    }
    public function create(){
        $this->addPage=true;
    }
    public function store(){
        $this->validate([
            'nopolisi' => 'required',
            'merk' => 'required',
            'jenis' => 'required',
            'harga' => 'required',
            'foto' => 'required|image',
        ],[
            'nopolisi.required' => 'Nomor Polisi Tidak boleh kosong',
            'merk.required' => 'Merk Tidak boleh kosong',
            'jenis.required' => 'Jenis Mobil Tidak boleh kosong',
            'harga.required' => 'Harga Tidak boleh kosong',
            'foto.required' => 'Foto Tidak boleh kosong',
            'foto.image' => 'Foto dalam format image',
        ]);

        $this->foto->storeAs('mobil', $this->foto->hashName(), 'public');
        Mobil::create([
            'user_id' => Auth::user()->id,
            'nopolisi'=> $this->nopolisi,
            'merk'=>$this->merk,
            'jenis' => $this->jenis,
            'harga' =>$this->harga,
            'foto'=>$this->foto->hashName()

        ]);
        session()->flash('success','Berhasil simpan Data!');
        $this->reset();
    }
   public function edit($id){
    $this->editPage = true;
    $this->id = $id; // Simpan ID dengan benar
    $mobil = Mobil::find($id);

    if (!$mobil) {
        session()->flash('error', 'Mobil tidak ditemukan!');
        return;
    }

    $this->nopolisi = $mobil->nopolisi;
    $this->merk = $mobil->merk;
    $this->jenis = $mobil->jenis;
    $this->harga = $mobil->harga;
}

public function update(){
    $mobil = Mobil::find($this->id);

    // Periksa apakah mobil ditemukan
    if (!$mobil) {
        session()->flash('error', 'Mobil tidak ditemukan!');
        return;
    }

    if (empty($this->foto)) {
        $mobil->update([
            'user_id' => Auth::user()->id,
            'nopolisi' => $this->nopolisi,
            'merk' => $this->merk,
            'jenis' => $this->jenis,
            'harga' => $this->harga,
        ]);
    } else {
        // Hapus foto lama jika ada
        if (!empty($mobil->foto) && file_exists(public_path('storage/mobil/' . $mobil->foto))) {
            unlink(public_path('storage/mobil/' . $mobil->foto));
        }

        // Simpan foto baru
        $this->foto->storeAs('mobil', $this->foto->hashName(), 'public');
        $mobil->update([
            'user_id' => Auth::user()->id,
            'nopolisi' => $this->nopolisi,
            'merk' => $this->merk,
            'jenis' => $this->jenis,
            'harga' => $this->harga,
            'foto' => $this->foto->hashName(),
        ]);
    }

    session()->flash('success', 'Berhasil diubah');
    $this->reset(); // Reset semua properti
}
}

