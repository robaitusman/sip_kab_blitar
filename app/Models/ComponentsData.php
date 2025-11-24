<?php 
namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/**
 * Components data Model
 * Use for getting values from the database for page components
 * Support raw query builder
 * @category Model
 */
class ComponentsData{
	

	/**
     * role_id_option_list Model Action
     * @return array
     */
	function role_id_option_list(){
		$sqltext = "SELECT role_id as value, role_name as label FROM roles";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * Check if value already exist in Users table
	 * @param string $value
     * @return bool
     */
	function users_username_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('users')->where('username', $value)->value('username');   
		if($exist){
			return true;
		}
		return false;
	}
	

	/**
     * Check if value already exist in Users table
	 * @param string $value
     * @return bool
     */
	function users_email_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('users')->where('email', $value)->value('email');   
		if($exist){
			return true;
		}
		return false;
	}
	

	/**
     * id_kecamatan_option_list Model Action
     * @return array
     */
	function id_kecamatan_option_list(){
		$sqltext = "SELECT  DISTINCT id AS value,nama AS label FROM kecamatan";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * tahun_option_list Model Action
     * @return array
     */
	function tahun_option_list(){
		$sqltext = "SELECT
    YEAR(harga_produsen.tanggal) AS value,
    YEAR(harga_produsen.tanggal) AS label
FROM
    harga_produsen
GROUP BY
    value, label
";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
	* barchart_gkppetani Model Action
	* @return array
	*/
	function barchart_gkppetani(){
		$request = request();
		$chart_data  = [];
		$sqltext = "SELECT kecamatan.nama, ROUND(AVG(harga_produsen.gkp_petani), 0) AS rata_rata_gkp_petani FROM harga_produsen INNER JOIN kecamatan ON harga_produsen.id_kecamatan = kecamatan.id WHERE MONTH(harga_produsen.tanggal) =:bulan AND YEAR(harga_produsen.tanggal) = :tahun GROUP BY kecamatan.nama ORDER BY rata_rata_gkp_petani DESC" ;
		$query_params = [];
$query_params['bulan'] = $request->query('bulan');
$query_params['tahun'] = $request->query('tahun');
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'nama');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'rata_rata_gkp_petani'),
			'label' => "",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset1;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
	

	/**
	* barchart_gkgpenggilingan Model Action
	* @return array
	*/
	function barchart_gkgpenggilingan(){
		$request = request();
		$chart_data  = [];
		$sqltext = "SELECT kecamatan.nama, ROUND(AVG(harga_produsen.gkg_penggilingan), 0) AS rata_rata_gkg_penggilingan FROM harga_produsen INNER JOIN kecamatan ON harga_produsen.id_kecamatan = kecamatan.id WHERE MONTH(harga_produsen.tanggal) =:bulan AND YEAR(harga_produsen.tanggal) = :tahun GROUP BY kecamatan.nama ORDER BY rata_rata_gkg_penggilingan DESC" ;
		$query_params = [];
$query_params['bulan'] = $request->query('bulan');
$query_params['tahun'] = $request->query('tahun');
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'nama');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'rata_rata_gkg_penggilingan'),
			'label' => "",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset1;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
	

	/**
	* barchart_beraspremium Model Action
	* @return array
	*/
	function barchart_beraspremium(){
		$request = request();
		$chart_data  = [];
		$sqltext = "SELECT kecamatan.nama, ROUND(AVG(harga_produsen.beras_premium), 0) AS rata_rata_beras_premium FROM harga_produsen INNER JOIN kecamatan ON harga_produsen.id_kecamatan = kecamatan.id WHERE MONTH(harga_produsen.tanggal) =:bulan AND YEAR(harga_produsen.tanggal) = :tahun GROUP BY kecamatan.nama ORDER BY rata_rata_beras_premium DESC" ;
		$query_params = [];
$query_params['bulan'] = $request->query('bulan');
$query_params['tahun'] = $request->query('tahun');
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'nama');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'rata_rata_beras_premium'),
			'label' => "",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset1;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
	

	/**
	* barchart_berasmedium Model Action
	* @return array
	*/
	function barchart_berasmedium(){
		$request = request();
		$chart_data  = [];
		$sqltext = "SELECT kecamatan.nama, ROUND(AVG(harga_produsen.beras_medium), 0) AS rata_rata_beras_medium FROM harga_produsen INNER JOIN kecamatan ON harga_produsen.id_kecamatan = kecamatan.id WHERE MONTH(harga_produsen.tanggal) =:bulan AND YEAR(harga_produsen.tanggal) = :tahun GROUP BY kecamatan.nama ORDER BY rata_rata_beras_medium DESC" ;
		$query_params = [];
$query_params['bulan'] = $request->query('bulan');
$query_params['tahun'] = $request->query('tahun');
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'nama');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'rata_rata_beras_medium'),
			'label' => "",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset1;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
	

	/**
	* barchart_jagungpipilankering Model Action
	* @return array
	*/
	function barchart_jagungpipilankering(){
		$request = request();
		$chart_data  = [];
		$sqltext = "SELECT kecamatan.nama, ROUND(AVG(harga_produsen.jagung_pipilan_kering), 0) AS rata_rata_jagung_pipilan_kering FROM harga_produsen INNER JOIN kecamatan ON harga_produsen.id_kecamatan = kecamatan.id WHERE MONTH(harga_produsen.tanggal) =:bulan AND YEAR(harga_produsen.tanggal) = :tahun GROUP BY kecamatan.nama ORDER BY rata_rata_jagung_pipilan_kering DESC" ;
		$query_params = [];
$query_params['bulan'] = $request->query('bulan');
$query_params['tahun'] = $request->query('tahun');
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'nama');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'rata_rata_jagung_pipilan_kering'),
			'label' => "",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset1;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
	

	/**
	* barchart_ubikayu Model Action
	* @return array
	*/
	function barchart_ubikayu(){
		$request = request();
		$chart_data  = [];
		$sqltext = "SELECT kecamatan.nama, ROUND(AVG(harga_produsen.ubi_kayu), 0) AS rata_rata_ubi_kayu FROM harga_produsen INNER JOIN kecamatan ON harga_produsen.id_kecamatan = kecamatan.id WHERE MONTH(harga_produsen.tanggal) =:bulan AND YEAR(harga_produsen.tanggal) = :tahun GROUP BY kecamatan.nama ORDER BY rata_rata_ubi_kayu DESC" ;
		$query_params = [];
$query_params['bulan'] = $request->query('bulan');
$query_params['tahun'] = $request->query('tahun');
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'nama');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'rata_rata_ubi_kayu'),
			'label' => "",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset1;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
	

	/**
	* barchart_ubijalar Model Action
	* @return array
	*/
	function barchart_ubijalar(){
		$request = request();
		$chart_data  = [];
		$sqltext = "SELECT kecamatan.nama, ROUND(AVG(harga_produsen.ubi_jalar), 0) AS rata_rata_ubi_jalar FROM harga_produsen INNER JOIN kecamatan ON harga_produsen.id_kecamatan = kecamatan.id WHERE MONTH(harga_produsen.tanggal) =:bulan AND YEAR(harga_produsen.tanggal) = :tahun GROUP BY kecamatan.nama ORDER BY rata_rata_ubi_jalar DESC" ;
		$query_params = [];
$query_params['bulan'] = $request->query('bulan');
$query_params['tahun'] = $request->query('tahun');
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'nama');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'rata_rata_ubi_jalar'),
			'label' => "",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset1;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
	

	/**
	* barchart_kedelailokalkering Model Action
	* @return array
	*/
	function barchart_kedelailokalkering(){
		$request = request();
		$chart_data  = [];
		$sqltext = "SELECT kecamatan.nama, ROUND(AVG(harga_produsen.kedelai_lokal_kering), 0) AS rata_rata_kedelai_lokal_kering FROM harga_produsen INNER JOIN kecamatan ON harga_produsen.id_kecamatan = kecamatan.id WHERE MONTH(harga_produsen.tanggal) =:bulan AND YEAR(harga_produsen.tanggal) = :tahun GROUP BY kecamatan.nama ORDER BY rata_rata_kedelai_lokal_kering DESC" ;
		$query_params = [];
$query_params['bulan'] = $request->query('bulan');
$query_params['tahun'] = $request->query('tahun');
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'nama');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'rata_rata_kedelai_lokal_kering'),
			'label' => "",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset1;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
	

	/**
	* barchart_cabebesar Model Action
	* @return array
	*/
	function barchart_cabebesar(){
		$request = request();
		$chart_data  = [];
		$sqltext = "SELECT kecamatan.nama, ROUND(AVG(harga_produsen.cabe_besar), 0) AS rata_rata_cabe_besar FROM harga_produsen INNER JOIN kecamatan ON harga_produsen.id_kecamatan = kecamatan.id WHERE MONTH(harga_produsen.tanggal) =:bulan AND YEAR(harga_produsen.tanggal) = :tahun GROUP BY kecamatan.nama ORDER BY rata_rata_cabe_besar DESC" ;
		$query_params = [];
$query_params['bulan'] = $request->query('bulan');
$query_params['tahun'] = $request->query('tahun');
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'nama');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'rata_rata_cabe_besar'),
			'label' => "",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset1;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
	

	/**
	* barchart_caberawitmerah Model Action
	* @return array
	*/
	function barchart_caberawitmerah(){
		$request = request();
		$chart_data  = [];
		$sqltext = "SELECT kecamatan.nama, 
       ROUND(AVG(harga_produsen.cabe_rawit_merah), 0) AS rata_rata_cabe_rawit_merah
FROM harga_produsen 
INNER JOIN kecamatan ON harga_produsen.id_kecamatan = kecamatan.id 
WHERE MONTH(harga_produsen.tanggal) = :bulan 
  AND YEAR(harga_produsen.tanggal) = :tahun 
GROUP BY kecamatan.nama 
ORDER BY rata_rata_cabe_rawit_merah DESC;" ;
		$query_params = [];
$query_params['bulan'] = $request->query('bulan');
$query_params['tahun'] = $request->query('tahun');
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'nama');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'rata_rata_cabe_rawit_merah'),
			'label' => "",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset1;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
	

	/**
	* barchart_cabekeriting Model Action
	* @return array
	*/
	function barchart_cabekeriting(){
		$request = request();
		$chart_data  = [];
		$sqltext = "SELECT kecamatan.nama, 
       ROUND(AVG(harga_produsen.cabe_keriting), 0) AS rata_rata_cabe_keriting
FROM harga_produsen 
INNER JOIN kecamatan ON harga_produsen.id_kecamatan = kecamatan.id 
WHERE MONTH(harga_produsen.tanggal) = :bulan 
  AND YEAR(harga_produsen.tanggal) = :tahun 
GROUP BY kecamatan.nama 
ORDER BY rata_rata_cabe_keriting DESC;" ;
		$query_params = [];
$query_params['bulan'] = $request->query('bulan');
$query_params['tahun'] = $request->query('tahun');
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'nama');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'rata_rata_cabe_keriting'),
			'label' => "",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset1;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
	

	/**
	* barchart_bawangmerah Model Action
	* @return array
	*/
	function barchart_bawangmerah(){
		$request = request();
		$chart_data  = [];
		$sqltext = "SELECT kecamatan.nama, 
       ROUND(AVG(harga_produsen.bawang_merah), 0) AS rata_rata_bawang_merah
FROM harga_produsen 
INNER JOIN kecamatan ON harga_produsen.id_kecamatan = kecamatan.id 
WHERE MONTH(harga_produsen.tanggal) = :bulan 
  AND YEAR(harga_produsen.tanggal) = :tahun 
GROUP BY kecamatan.nama 
ORDER BY rata_rata_bawang_merah DESC;" ;
		$query_params = [];
$query_params['bulan'] = $request->query('bulan');
$query_params['tahun'] = $request->query('tahun');
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'nama');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'rata_rata_bawang_merah'),
			'label' => "",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset1;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
	

	/**
	* barchart_dagingayam Model Action
	* @return array
	*/
	function barchart_dagingayam(){
		$request = request();
		$chart_data  = [];
		$sqltext = "SELECT kecamatan.nama, 
       ROUND(AVG(harga_produsen.daging_ayam), 0) AS rata_rata_daging_ayam
FROM harga_produsen 
INNER JOIN kecamatan ON harga_produsen.id_kecamatan = kecamatan.id 
WHERE MONTH(harga_produsen.tanggal) = :bulan 
  AND YEAR(harga_produsen.tanggal) = :tahun 
GROUP BY kecamatan.nama 
ORDER BY rata_rata_daging_ayam DESC;" ;
		$query_params = [];
$query_params['bulan'] = $request->query('bulan');
$query_params['tahun'] = $request->query('tahun');
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'nama');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'rata_rata_daging_ayam'),
			'label' => "",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset1;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
	

	/**
	* barchart_dagingsapi Model Action
	* @return array
	*/
	function barchart_dagingsapi(){
		$request = request();
		$chart_data  = [];
		$sqltext = "SELECT kecamatan.nama, 
       ROUND(AVG(harga_produsen.daging_sapi), 0) AS rata_rata_daging_sapi
FROM harga_produsen 
INNER JOIN kecamatan ON harga_produsen.id_kecamatan = kecamatan.id 
WHERE MONTH(harga_produsen.tanggal) = :bulan 
  AND YEAR(harga_produsen.tanggal) = :tahun 
GROUP BY kecamatan.nama 
ORDER BY rata_rata_daging_sapi DESC;" ;
		$query_params = [];
$query_params['bulan'] = $request->query('bulan');
$query_params['tahun'] = $request->query('tahun');
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'nama');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'rata_rata_daging_sapi'),
			'label' => "",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset1;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
	

	/**
	* barchart_telurayamras Model Action
	* @return array
	*/
	function barchart_telurayamras(){
		$request = request();
		$chart_data  = [];
		$sqltext = "SELECT kecamatan.nama, 
       ROUND(AVG(harga_produsen.telur_ayam_ras), 0) AS rata_rata_telur_ayam_ras
FROM harga_produsen 
INNER JOIN kecamatan ON harga_produsen.id_kecamatan = kecamatan.id 
WHERE MONTH(harga_produsen.tanggal) = :bulan 
  AND YEAR(harga_produsen.tanggal) = :tahun 
GROUP BY kecamatan.nama 
ORDER BY rata_rata_telur_ayam_ras DESC;" ;
		$query_params = [];
$query_params['bulan'] = $request->query('bulan');
$query_params['tahun'] = $request->query('tahun');
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'nama');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'rata_rata_telur_ayam_ras'),
			'label' => "",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset1;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
	

	/**
	* barchart_pisang Model Action
	* @return array
	*/
	function barchart_pisang(){
		$request = request();
		$chart_data  = [];
		$sqltext = "SELECT kecamatan.nama, 
       ROUND(AVG(harga_produsen.pisang), 0) AS rata_rata_pisang
FROM harga_produsen 
INNER JOIN kecamatan ON harga_produsen.id_kecamatan = kecamatan.id 
WHERE MONTH(harga_produsen.tanggal) = :bulan 
  AND YEAR(harga_produsen.tanggal) = :tahun 
GROUP BY kecamatan.nama 
ORDER BY rata_rata_pisang DESC;" ;
		$query_params = [];
$query_params['bulan'] = $request->query('bulan');
$query_params['tahun'] = $request->query('tahun');
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'nama');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'rata_rata_pisang'),
			'label' => "",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset1;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
	

	/**
	* barchart_jeruk Model Action
	* @return array
	*/
	function barchart_jeruk(){
		$request = request();
		$chart_data  = [];
		$sqltext = "SELECT kecamatan.nama, 
       ROUND(AVG(harga_produsen.jeruk), 0) AS rata_rata_jeruk
FROM harga_produsen 
INNER JOIN kecamatan ON harga_produsen.id_kecamatan = kecamatan.id 
WHERE MONTH(harga_produsen.tanggal) = :bulan 
  AND YEAR(harga_produsen.tanggal) = :tahun 
GROUP BY kecamatan.nama 
ORDER BY rata_rata_jeruk DESC;" ;
		$query_params = [];
$query_params['bulan'] = $request->query('bulan');
$query_params['tahun'] = $request->query('tahun');
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'nama');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'rata_rata_jeruk'),
			'label' => "",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset1;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
	

	/**
     * getcount_hargaprodusen Model Action
     * @return int
     */
	function getcount_hargaprodusen(){
		$sqltext = "SELECT COUNT(*) AS num FROM harga_produsen";
		$query_params = [];
		$val = DB::selectOne($sqltext, $query_params);
		return $val->num;
	}
	

	/**
     * getcount_publikasipangan Model Action
     * @return int
     */
	function getcount_publikasipangan(){
		$sqltext = "SELECT COUNT(*) AS num FROM publikasi_pangan";
		$query_params = [];
		$val = DB::selectOne($sqltext, $query_params);
		return $val->num;
	}
}
