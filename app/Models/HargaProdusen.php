<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class HargaProdusen extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'harga_produsen';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'tanggal','gkp_petani','gkg_penggilingan','beras_premium','beras_medium','jagung_pipilan_kering','cabe_besar','cabe_rawit_merah','cabe_keriting','bawang_merah','daging_ayam','daging_sapi','telur_ayam_ras','pisang','jeruk','id_kecamatan','ubi_kayu','ubi_jalar','kedelai_lokal_kering'
	];
	public $timestamps = true;
	const CREATED_AT = 'date_created'; 
	const UPDATED_AT = 'date_updated'; 
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				harga_produsen.id LIKE ?  OR 
				harga_produsen.tanggal LIKE ?  OR 
				kecamatan.id LIKE ?  OR 
				kecamatan.nama LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%"
		];
		//setting search conditions
		$query->whereRaw($search_condition, $search_params);
	}
	

	/**
     * return list page fields of the model.
     * 
     * @return array
     */
	public static function listFields(){
		return [ 
			"harga_produsen.id AS id",
			"harga_produsen.tanggal AS tanggal",
			"harga_produsen.gkp_petani AS gkp_petani",
			"harga_produsen.gkg_penggilingan AS gkg_penggilingan",
			"harga_produsen.beras_premium AS beras_premium",
			"harga_produsen.beras_medium AS beras_medium",
			"harga_produsen.jagung_pipilan_kering AS jagung_pipilan_kering",
			"harga_produsen.cabe_besar AS cabe_besar",
			"harga_produsen.cabe_rawit_merah AS cabe_rawit_merah",
			"harga_produsen.cabe_keriting AS cabe_keriting",
			"harga_produsen.bawang_merah AS bawang_merah",
			"harga_produsen.daging_ayam AS daging_ayam",
			"harga_produsen.daging_sapi AS daging_sapi",
			"harga_produsen.telur_ayam_ras AS telur_ayam_ras",
			"harga_produsen.pisang AS pisang",
			"harga_produsen.jeruk AS jeruk",
			"harga_produsen.id_kecamatan AS id_kecamatan",
			"kecamatan.id AS kecamatan_id",
			"kecamatan.nama AS kecamatan_nama",
			"harga_produsen.ubi_kayu AS ubi_kayu",
			"harga_produsen.ubi_jalar AS ubi_jalar",
			"harga_produsen.kedelai_lokal_kering AS kedelai_lokal_kering" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"harga_produsen.id AS id",
			"harga_produsen.tanggal AS tanggal",
			"harga_produsen.gkp_petani AS gkp_petani",
			"harga_produsen.gkg_penggilingan AS gkg_penggilingan",
			"harga_produsen.beras_premium AS beras_premium",
			"harga_produsen.beras_medium AS beras_medium",
			"harga_produsen.jagung_pipilan_kering AS jagung_pipilan_kering",
			"harga_produsen.cabe_besar AS cabe_besar",
			"harga_produsen.cabe_rawit_merah AS cabe_rawit_merah",
			"harga_produsen.cabe_keriting AS cabe_keriting",
			"harga_produsen.bawang_merah AS bawang_merah",
			"harga_produsen.daging_ayam AS daging_ayam",
			"harga_produsen.daging_sapi AS daging_sapi",
			"harga_produsen.telur_ayam_ras AS telur_ayam_ras",
			"harga_produsen.pisang AS pisang",
			"harga_produsen.jeruk AS jeruk",
			"harga_produsen.id_kecamatan AS id_kecamatan",
			"kecamatan.id AS kecamatan_id",
			"kecamatan.nama AS kecamatan_nama",
			"harga_produsen.ubi_kayu AS ubi_kayu",
			"harga_produsen.ubi_jalar AS ubi_jalar",
			"harga_produsen.kedelai_lokal_kering AS kedelai_lokal_kering" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"harga_produsen.id AS id",
			"harga_produsen.gkp_petani AS gkp_petani",
			"harga_produsen.gkg_penggilingan AS gkg_penggilingan",
			"harga_produsen.beras_premium AS beras_premium",
			"harga_produsen.beras_medium AS beras_medium",
			"harga_produsen.jagung_pipilan_kering AS jagung_pipilan_kering",
			"harga_produsen.cabe_besar AS cabe_besar",
			"harga_produsen.cabe_rawit_merah AS cabe_rawit_merah",
			"harga_produsen.cabe_keriting AS cabe_keriting",
			"harga_produsen.bawang_merah AS bawang_merah",
			"harga_produsen.daging_ayam AS daging_ayam",
			"harga_produsen.daging_sapi AS daging_sapi",
			"harga_produsen.telur_ayam_ras AS telur_ayam_ras",
			"harga_produsen.id_kecamatan AS id_kecamatan",
			"harga_produsen.date_created AS date_created",
			"harga_produsen.date_updated AS date_updated",
			"harga_produsen.pisang AS pisang",
			"harga_produsen.jeruk AS jeruk",
			"kecamatan.id AS kecamatan_id",
			"kecamatan.nama AS kecamatan_nama",
			"kecamatan.date_created AS kecamatan_date_created",
			"kecamatan.date_updated AS kecamatan_date_updated",
			"harga_produsen.tanggal AS tanggal",
			"harga_produsen.ubi_kayu AS ubi_kayu",
			"harga_produsen.ubi_jalar AS ubi_jalar",
			"harga_produsen.kedelai_lokal_kering AS kedelai_lokal_kering" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"harga_produsen.id AS id",
			"harga_produsen.gkp_petani AS gkp_petani",
			"harga_produsen.gkg_penggilingan AS gkg_penggilingan",
			"harga_produsen.beras_premium AS beras_premium",
			"harga_produsen.beras_medium AS beras_medium",
			"harga_produsen.jagung_pipilan_kering AS jagung_pipilan_kering",
			"harga_produsen.cabe_besar AS cabe_besar",
			"harga_produsen.cabe_rawit_merah AS cabe_rawit_merah",
			"harga_produsen.cabe_keriting AS cabe_keriting",
			"harga_produsen.bawang_merah AS bawang_merah",
			"harga_produsen.daging_ayam AS daging_ayam",
			"harga_produsen.daging_sapi AS daging_sapi",
			"harga_produsen.telur_ayam_ras AS telur_ayam_ras",
			"harga_produsen.id_kecamatan AS id_kecamatan",
			"harga_produsen.date_created AS date_created",
			"harga_produsen.date_updated AS date_updated",
			"harga_produsen.pisang AS pisang",
			"harga_produsen.jeruk AS jeruk",
			"kecamatan.id AS kecamatan_id",
			"kecamatan.nama AS kecamatan_nama",
			"kecamatan.date_created AS kecamatan_date_created",
			"kecamatan.date_updated AS kecamatan_date_updated",
			"harga_produsen.tanggal AS tanggal",
			"harga_produsen.ubi_kayu AS ubi_kayu",
			"harga_produsen.ubi_jalar AS ubi_jalar",
			"harga_produsen.kedelai_lokal_kering AS kedelai_lokal_kering" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"tanggal",
			"gkp_petani",
			"gkg_penggilingan",
			"beras_premium",
			"beras_medium",
			"jagung_pipilan_kering",
			"cabe_besar",
			"cabe_rawit_merah",
			"cabe_keriting",
			"bawang_merah",
			"daging_ayam",
			"daging_sapi",
			"telur_ayam_ras",
			"pisang",
			"jeruk",
			"id_kecamatan",
			"ubi_kayu",
			"ubi_jalar",
			"kedelai_lokal_kering",
			"id" 
		];
	}
	

	/**
     * return hargaProdusenSaya page fields of the model.
     * 
     * @return array
     */
	public static function hargaProdusenSayaFields(){
		return [ 
			"harga_produsen.id AS id",
			"harga_produsen.tanggal AS tanggal",
			"harga_produsen.gkp_petani AS gkp_petani",
			"harga_produsen.gkg_penggilingan AS gkg_penggilingan",
			"harga_produsen.beras_premium AS beras_premium",
			"harga_produsen.beras_medium AS beras_medium",
			"harga_produsen.jagung_pipilan_kering AS jagung_pipilan_kering",
			"harga_produsen.ubi_kayu AS ubi_kayu",
			"harga_produsen.ubi_jalar AS ubi_jalar",
			"harga_produsen.kedelai_lokal_kering AS kedelai_lokal_kering",
			"harga_produsen.cabe_besar AS cabe_besar",
			"harga_produsen.cabe_rawit_merah AS cabe_rawit_merah",
			"harga_produsen.cabe_keriting AS cabe_keriting",
			"harga_produsen.bawang_merah AS bawang_merah",
			"harga_produsen.daging_ayam AS daging_ayam",
			"harga_produsen.daging_sapi AS daging_sapi",
			"harga_produsen.telur_ayam_ras AS telur_ayam_ras",
			"harga_produsen.pisang AS pisang",
			"harga_produsen.jeruk AS jeruk",
			"kecamatan.id AS kecamatan_id" 
		];
	}
	

	/**
     * return exportHargaProdusenSaya page fields of the model.
     * 
     * @return array
     */
	public static function exportHargaProdusenSayaFields(){
		return [ 
			"harga_produsen.id AS id",
			"harga_produsen.tanggal AS tanggal",
			"harga_produsen.gkp_petani AS gkp_petani",
			"harga_produsen.gkg_penggilingan AS gkg_penggilingan",
			"harga_produsen.beras_premium AS beras_premium",
			"harga_produsen.beras_medium AS beras_medium",
			"harga_produsen.jagung_pipilan_kering AS jagung_pipilan_kering",
			"harga_produsen.ubi_kayu AS ubi_kayu",
			"harga_produsen.ubi_jalar AS ubi_jalar",
			"harga_produsen.kedelai_lokal_kering AS kedelai_lokal_kering",
			"harga_produsen.cabe_besar AS cabe_besar",
			"harga_produsen.cabe_rawit_merah AS cabe_rawit_merah",
			"harga_produsen.cabe_keriting AS cabe_keriting",
			"harga_produsen.bawang_merah AS bawang_merah",
			"harga_produsen.daging_ayam AS daging_ayam",
			"harga_produsen.daging_sapi AS daging_sapi",
			"harga_produsen.telur_ayam_ras AS telur_ayam_ras",
			"harga_produsen.pisang AS pisang",
			"harga_produsen.jeruk AS jeruk",
			"kecamatan.id AS kecamatan_id" 
		];
	}
	public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan');
    }
}
