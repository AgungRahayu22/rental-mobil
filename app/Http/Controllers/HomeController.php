<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mobil;
use App\Models\Transaksi;

class HomeController extends Controller
{
    public function index()
    {
        $data['mobil']=Mobil::count();
        $data['transaksi']=Transaksi::where('status','SELESAI')->sum('total');
        $data['user']=User::count();
        return view('home',$data);
    }
}
