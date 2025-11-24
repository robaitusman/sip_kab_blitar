<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataHargaController extends Controller
{
    public function index(Request $request)
    {
        // Ambil tanggal dari request, jika tidak ada gunakan tanggal hari ini
        $selectedDate = $request->input('tanggal', date('Y-m-d'));
        $yesterday = date('Y-m-d', strtotime($selectedDate . ' -1 day'));

        // Fungsi untuk membuat query dengan NULLIF agar 0 tidak dihitung dalam AVG
        function avgWithNull($column)
        {
            return DB::raw("ROUND(AVG(NULLIF($column, 0))) AS avg_$column");
        }

        // Ambil rata-rata untuk tanggal yang dipilih
        $dataToday = DB::table('harga_produsen')
            ->select([
                avgWithNull('gkp_petani'),
                avgWithNull('gkg_penggilingan'),
                avgWithNull('beras_premium'),
                avgWithNull('beras_medium'),
                avgWithNull('jagung_pipilan_kering'),
                avgWithNull('ubi_kayu'),
                avgWithNull('ubi_jalar'),
                avgWithNull('kedelai_lokal_kering'),
                avgWithNull('cabe_besar'),
                avgWithNull('cabe_rawit_merah'),
                avgWithNull('cabe_keriting'),
                avgWithNull('bawang_merah'),
                avgWithNull('daging_ayam'),
                avgWithNull('daging_sapi'),
                avgWithNull('telur_ayam_ras'),
                avgWithNull('pisang'),
                avgWithNull('jeruk')
            ])
            ->where('tanggal', '=', $selectedDate)
            ->first();

        // Ambil rata-rata untuk kemarin
        $dataYesterday = DB::table('harga_produsen')
            ->select([
                DB::raw("ROUND(AVG(NULLIF(gkp_petani, 0))) AS avg_gkp_petani_kemaren"),
                DB::raw("ROUND(AVG(NULLIF(gkg_penggilingan, 0))) AS avg_gkg_penggilingan_kemaren"),
                DB::raw("ROUND(AVG(NULLIF(beras_premium, 0))) AS avg_beras_premium_kemaren"),
                DB::raw("ROUND(AVG(NULLIF(beras_medium, 0))) AS avg_beras_medium_kemaren"),
                DB::raw("ROUND(AVG(NULLIF(jagung_pipilan_kering, 0))) AS avg_jagung_pipilan_kering_kemaren"),
                DB::raw("ROUND(AVG(NULLIF(ubi_kayu, 0))) AS avg_ubi_kayu_kemaren"),
                DB::raw("ROUND(AVG(NULLIF(ubi_jalar, 0))) AS avg_ubi_jalar_kemaren"),
                DB::raw("ROUND(AVG(NULLIF(kedelai_lokal_kering, 0))) AS avg_kedelai_lokal_kering_kemaren"),
                DB::raw("ROUND(AVG(NULLIF(cabe_besar, 0))) AS avg_cabe_besar_kemaren"),
                DB::raw("ROUND(AVG(NULLIF(cabe_rawit_merah, 0))) AS avg_cabe_rawit_merah_kemaren"),
                DB::raw("ROUND(AVG(NULLIF(cabe_keriting, 0))) AS avg_cabe_keriting_kemaren"),
                DB::raw("ROUND(AVG(NULLIF(bawang_merah, 0))) AS avg_bawang_merah_kemaren"),
                DB::raw("ROUND(AVG(NULLIF(daging_ayam, 0))) AS avg_daging_ayam_kemaren"),
                DB::raw("ROUND(AVG(NULLIF(daging_sapi, 0))) AS avg_daging_sapi_kemaren"),
                DB::raw("ROUND(AVG(NULLIF(telur_ayam_ras, 0))) AS avg_telur_ayam_ras_kemaren"),
                DB::raw("ROUND(AVG(NULLIF(pisang, 0))) AS avg_pisang_kemaren"),
                DB::raw("ROUND(AVG(NULLIF(jeruk, 0))) AS avg_jeruk_kemaren")
            ])
            ->where('tanggal', '=', $yesterday)
            ->first();

        // Kirim data ke view
        return view('custom.dataharga', compact('dataToday', 'dataYesterday', 'selectedDate'));
    }
}
