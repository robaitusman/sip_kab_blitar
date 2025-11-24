<?php

namespace App\Http\Controllers;

use App\Models\Nbm;
use App\Models\DataPangan;
use Illuminate\Http\Request;
use App\Models\PublikasiPangan;

class PublicController extends Controller
{
    
    public function nbmpublic(){
        $nbm = Nbm::with('kecamatan')->paginate(5);
        return view('custom/nbm',compact('nbm'));
    }
    public function datapanganpublic(){
        $dataPangan = DataPangan::with('kecamatan')->paginate(5);
        return view('custom/datapangan', compact('dataPangan'));
    }
    public function publikasipanganpublic(){
        $publikasiPangan = PublikasiPangan::with('kecamatan')->get();
        return view('custom/publikasipangan',compact('publikasiPangan'));
    }
    public function tentang(){
        return view('custom/tentang');
    }
    
}
