<?php
namespace App\Http\Controllers;
use App\Models\DataPangan;
use Illuminate\Http\Request;
use App\Models\HargaProdusen;
use App\Models\PublikasiPangan;
use App\Charts\HargaProdusenChart;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

/**
 * Index Page Controller
 * @category  Controller
 */
class IndexController extends Controller{
	/**
     * index Action
     * @return View
     */
		public function index(HargaProdusenChart $chart){
               $publikasiPangan = PublikasiPangan::with('kecamatan')->latest()->take(3)->get();
               // $dataharga = HargaProdusen::with('kecamatan')->latest()->take(1)->get();

              $dataharga = DB::table('harga_produsen')
    ->select([
        DB::raw('ROUND(AVG(CASE WHEN gkp_petani > 0 THEN gkp_petani ELSE NULL END)) AS gkp_petani'),
        DB::raw('ROUND(AVG(CASE WHEN gkg_penggilingan > 0 THEN gkg_penggilingan ELSE NULL END)) AS gkg_penggilingan'),
        DB::raw('ROUND(AVG(CASE WHEN beras_premium > 0 THEN beras_premium ELSE NULL END)) AS beras_premium'),
        DB::raw('ROUND(AVG(CASE WHEN beras_medium > 0 THEN beras_medium ELSE NULL END)) AS beras_medium'),
        DB::raw('ROUND(AVG(CASE WHEN jagung_pipilan_kering > 0 THEN jagung_pipilan_kering ELSE NULL END)) AS jagung_pipilan_kering'),
        DB::raw('ROUND(AVG(CASE WHEN ubi_kayu > 0 THEN ubi_kayu ELSE NULL END)) AS ubi_kayu'),
        DB::raw('ROUND(AVG(CASE WHEN ubi_jalar > 0 THEN ubi_jalar ELSE NULL END)) AS ubi_jalar'),
        DB::raw('ROUND(AVG(CASE WHEN kedelai_lokal_kering > 0 THEN kedelai_lokal_kering ELSE NULL END)) AS kedelai_lokal_kering'),
        DB::raw('ROUND(AVG(CASE WHEN cabe_besar > 0 THEN cabe_besar ELSE NULL END)) AS cabe_besar'),
        DB::raw('ROUND(AVG(CASE WHEN cabe_rawit_merah > 0 THEN cabe_rawit_merah ELSE NULL END)) AS cabe_rawit_merah'),
        DB::raw('ROUND(AVG(CASE WHEN cabe_keriting > 0 THEN cabe_keriting ELSE NULL END)) AS cabe_keriting'),
        DB::raw('ROUND(AVG(CASE WHEN bawang_merah > 0 THEN bawang_merah ELSE NULL END)) AS bawang_merah'),
        DB::raw('ROUND(AVG(CASE WHEN daging_ayam > 0 THEN daging_ayam ELSE NULL END)) AS daging_ayam'),
        DB::raw('ROUND(AVG(CASE WHEN daging_sapi > 0 THEN daging_sapi ELSE NULL END)) AS daging_sapi'),
        DB::raw('ROUND(AVG(CASE WHEN telur_ayam_ras > 0 THEN telur_ayam_ras ELSE NULL END)) AS telur_ayam_ras'),
        DB::raw('ROUND(AVG(CASE WHEN pisang > 0 THEN pisang ELSE NULL END)) AS pisang'),
        DB::raw('ROUND(AVG(CASE WHEN jeruk > 0 THEN jeruk ELSE NULL END)) AS jeruk'),
        'tanggal'
    ])
    ->where('tanggal', '=', function($query) {
        $query->select(DB::raw('MAX(tanggal)'))
              ->from('harga_produsen');
    })
    ->groupBy('tanggal')
    ->first();

            

          //   dd($dataharga);
            
			return view('custom.index',['chart' =>$chart->build()],compact('publikasiPangan', 'dataharga'));
			}
		
	/** 
     * Login Action
     * @return View
     */
	public function login(){
        return view("pages.index.login");
    }
}