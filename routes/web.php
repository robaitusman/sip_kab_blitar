<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Services\KonsumenFetcher;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\DataHargaController;
use App\Http\Controllers\CommodityGraphController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



	Route::get('', 'IndexController@index')->name('index')->middleware(['redirect.to.home']);
	Route::get('index/login', 'IndexController@login')->name('login');
	
	Route::post('auth/login', 'AuthController@login')->name('auth.login');
	Route::any('auth/logout', 'AuthController@logout')->name('logout')->middleware(['auth']);

	Route::get('auth/accountcreated', 'AuthController@accountcreated')->name('accountcreated');
	Route::get('auth/accountpending', 'AuthController@accountpending')->name('accountpending');
	Route::get('auth/accountblocked', 'AuthController@accountblocked')->name('accountblocked');
	Route::get('auth/accountinactive', 'AuthController@accountinactive')->name('accountinactive');


	
	Route::get('index/register', 'AuthController@register')->name('auth.register')->middleware(['redirect.to.home']);
	Route::post('index/register', 'AuthController@register_store')->name('auth.register_store');
		
	Route::post('auth/login', 'AuthController@login')->name('auth.login');
	Route::get('auth/password/forgotpassword', 'AuthController@showForgotPassword')->name('password.forgotpassword');
	Route::post('auth/password/sendemail', 'AuthController@sendPasswordResetLink')->name('password.email');
	Route::get('auth/password/reset', 'AuthController@showResetPassword')->name('password.reset.token');
	Route::post('auth/password/resetpassword', 'AuthController@resetPassword')->name('password.resetpassword');
	Route::get('auth/password/resetcompleted', 'AuthController@passwordResetCompleted')->name('password.resetcompleted');
	Route::get('auth/password/linksent', 'AuthController@passwordResetLinkSent')->name('password.resetlinksent');

	Route::get('nbmpublic', [PublicController::class, 'nbmpublic'])->name('custom.nbm');
	Route::get('datapanganpublic', [PublicController::class, 'datapanganpublic'])->name('custom.datapangan');
	Route::get('publikasipanganpublic', [PublicController::class, 'publikasipanganpublic'])->name('custom.publikasipangan');
	Route::get('tentang', [PublicController::class, 'tentang'])->name('custom.tentang');
	Route::get('datahargapublic', [DataHargaController::class, 'index'])->name('custom.dataharga');
	Route::get('/commodity-graph/{commodity}', [CommodityGraphController::class, 'index'])->name('custom.commodity_graph');
	Route::get('api/konsumen', function () {
		return response()->json(KonsumenFetcher::fetch());
	})->name('api.konsumen');
	

/**
 * All routes which requires auth
 */
Route::middleware(['auth', 'rbac', 'session.security'])->group(function () {
		
	Route::get('home', 'HomeController@index')->name('home');

	

/* routes for DataPangan Controller */
	Route::get('datapangan', 'DataPanganController@index')->name('datapangan.index');
	Route::get('datapangan/index/{filter?}/{filtervalue?}', 'DataPanganController@index')->name('datapangan.index');	
	Route::get('datapangan/view/{rec_id}', 'DataPanganController@view')->name('datapangan.view');	
	Route::get('datapangan/add', 'DataPanganController@add')->name('datapangan.add');
	Route::post('datapangan/add', 'DataPanganController@store')->name('datapangan.store');
		
	Route::any('datapangan/edit/{rec_id}', 'DataPanganController@edit')->name('datapangan.edit');	
	Route::get('datapangan/delete/{rec_id}', 'DataPanganController@delete');	
	Route::get('datapangan/data_pangan_saya', 'DataPanganController@data_pangan_saya');
	Route::get('datapangan/data_pangan_saya/{filter?}/{filtervalue?}', 'DataPanganController@data_pangan_saya');

/* routes for HargaProdusen Controller */
	Route::get('hargaprodusen', 'HargaProdusenController@index')->name('hargaprodusen.index');
	Route::get('hargaprodusen/index/{filter?}/{filtervalue?}', 'HargaProdusenController@index')->name('hargaprodusen.index');	
	Route::get('hargaprodusen/view/{rec_id}', 'HargaProdusenController@view')->name('hargaprodusen.view');	
	Route::get('hargaprodusen/add', 'HargaProdusenController@add')->name('hargaprodusen.add');
	Route::post('hargaprodusen/add', 'HargaProdusenController@store')->name('hargaprodusen.store');
		
	Route::any('hargaprodusen/edit/{rec_id}', 'HargaProdusenController@edit')->name('hargaprodusen.edit');	
	Route::get('hargaprodusen/delete/{rec_id}', 'HargaProdusenController@delete');	
	Route::get('hargaprodusen/harga_produsen_saya', 'HargaProdusenController@harga_produsen_saya');
	Route::get('hargaprodusen/harga_produsen_saya/{filter?}/{filtervalue?}', 'HargaProdusenController@harga_produsen_saya');

/* routes for Kecamatan Controller */
	Route::get('kecamatan', 'KecamatanController@index')->name('kecamatan.index');
	Route::get('kecamatan/index/{filter?}/{filtervalue?}', 'KecamatanController@index')->name('kecamatan.index');	
	Route::get('kecamatan/view/{rec_id}', 'KecamatanController@view')->name('kecamatan.view');	
	Route::get('kecamatan/add', 'KecamatanController@add')->name('kecamatan.add');
	Route::post('kecamatan/add', 'KecamatanController@store')->name('kecamatan.store');
		
	Route::any('kecamatan/edit/{rec_id}', 'KecamatanController@edit')->name('kecamatan.edit');	
	Route::get('kecamatan/delete/{rec_id}', 'KecamatanController@delete');

/* routes for Nbm Controller */
	Route::get('nbm', 'NbmController@index')->name('nbm.index');
	Route::get('nbm/index/{filter?}/{filtervalue?}', 'NbmController@index')->name('nbm.index');	
	Route::get('nbm/view/{rec_id}', 'NbmController@view')->name('nbm.view');	
	Route::get('nbm/add', 'NbmController@add')->name('nbm.add');
	Route::post('nbm/add', 'NbmController@store')->name('nbm.store');
		
	Route::any('nbm/edit/{rec_id}', 'NbmController@edit')->name('nbm.edit');	
	Route::get('nbm/delete/{rec_id}', 'NbmController@delete');	
	Route::get('nbm/nbm_saya', 'NbmController@nbm_saya');
	Route::get('nbm/nbm_saya/{filter?}/{filtervalue?}', 'NbmController@nbm_saya');

/* routes for Permissions Controller */
	Route::get('permissions', 'PermissionsController@index')->name('permissions.index');
	Route::get('permissions/index/{filter?}/{filtervalue?}', 'PermissionsController@index')->name('permissions.index');	
	Route::get('permissions/view/{rec_id}', 'PermissionsController@view')->name('permissions.view');	
	Route::get('permissions/add', 'PermissionsController@add')->name('permissions.add');
	Route::post('permissions/add', 'PermissionsController@store')->name('permissions.store');
		
	Route::any('permissions/edit/{rec_id}', 'PermissionsController@edit')->name('permissions.edit');	
	Route::get('permissions/delete/{rec_id}', 'PermissionsController@delete');

/* routes for PublikasiPangan Controller */
	Route::get('publikasipangan', 'PublikasiPanganController@index')->name('publikasipangan.index');
	Route::get('publikasipangan/index/{filter?}/{filtervalue?}', 'PublikasiPanganController@index')->name('publikasipangan.index');	
	Route::get('publikasipangan/view/{rec_id}', 'PublikasiPanganController@view')->name('publikasipangan.view');	
	Route::get('publikasipangan/add', 'PublikasiPanganController@add')->name('publikasipangan.add');
	Route::post('publikasipangan/add', 'PublikasiPanganController@store')->name('publikasipangan.store');
		
	Route::any('publikasipangan/edit/{rec_id}', 'PublikasiPanganController@edit')->name('publikasipangan.edit');	
	Route::get('publikasipangan/delete/{rec_id}', 'PublikasiPanganController@delete');	
	Route::get('publikasipangan/publikasi_pangan_saya', 'PublikasiPanganController@publikasi_pangan_saya');
	Route::get('publikasipangan/publikasi_pangan_saya/{filter?}/{filtervalue?}', 'PublikasiPanganController@publikasi_pangan_saya');

/* routes for Roles Controller */
	Route::get('roles', 'RolesController@index')->name('roles.index');
	Route::get('roles/index/{filter?}/{filtervalue?}', 'RolesController@index')->name('roles.index');	
	Route::get('roles/view/{rec_id}', 'RolesController@view')->name('roles.view');
	Route::get('roles/masterdetail/{rec_id}', 'RolesController@masterDetail')->name('roles.masterdetail')->withoutMiddleware(['rbac']);	
	Route::get('roles/add', 'RolesController@add')->name('roles.add');
	Route::post('roles/add', 'RolesController@store')->name('roles.store');
		
	Route::any('roles/edit/{rec_id}', 'RolesController@edit')->name('roles.edit');	
	Route::get('roles/delete/{rec_id}', 'RolesController@delete');

/* routes for Users Controller */
	Route::get('users', 'UsersController@index')->name('users.index');
	Route::get('users/index/{filter?}/{filtervalue?}', 'UsersController@index')->name('users.index');	
	Route::get('users/view/{rec_id}', 'UsersController@view')->name('users.view');	
	Route::any('account/edit', 'AccountController@edit')->name('account.edit');	
	Route::get('account', 'AccountController@index');	
	Route::post('account/changepassword', 'AccountController@changepassword')->name('account.changepassword');	
	Route::get('users/add', 'UsersController@add')->name('users.add');
	Route::post('users/add', 'UsersController@store')->name('users.store');
		
	Route::any('users/edit/{rec_id}', 'UsersController@edit')->name('users.edit');	
	Route::get('users/delete/{rec_id}', 'UsersController@delete');
});


	
Route::middleware(['auth', 'rbac'])->group(function () {
	Route::get('componentsdata/role_id_option_list',  function(Request $request){
			$compModel = new App\Models\ComponentsData();
			return $compModel->role_id_option_list($request);
		}
	);
		
	Route::get('componentsdata/users_username_value_exist',  function(Request $request){
			$compModel = new App\Models\ComponentsData();
			return $compModel->users_username_value_exist($request);
		}
	);
		
	Route::get('componentsdata/users_email_value_exist',  function(Request $request){
			$compModel = new App\Models\ComponentsData();
			return $compModel->users_email_value_exist($request);
		}
	);
		
	Route::get('componentsdata/id_kecamatan_option_list',  function(Request $request){
			$compModel = new App\Models\ComponentsData();
			return $compModel->id_kecamatan_option_list($request);
		}
	);
		
	Route::get('componentsdata/tahun_option_list',  function(Request $request){
			$compModel = new App\Models\ComponentsData();
			return $compModel->tahun_option_list($request);
		}
	);
		
	Route::get('componentsdata/barchart_gkppetani',  function(Request $request){
			$compModel = new App\Models\ComponentsData();
			return $compModel->barchart_gkppetani($request);
		}
	);
		
	Route::get('componentsdata/barchart_gkgpenggilingan',  function(Request $request){
			$compModel = new App\Models\ComponentsData();
			return $compModel->barchart_gkgpenggilingan($request);
		}
	);
		
	Route::get('componentsdata/barchart_beraspremium',  function(Request $request){
			$compModel = new App\Models\ComponentsData();
			return $compModel->barchart_beraspremium($request);
		}
	);
		
	Route::get('componentsdata/barchart_berasmedium',  function(Request $request){
			$compModel = new App\Models\ComponentsData();
			return $compModel->barchart_berasmedium($request);
		}
	);
		
	Route::get('componentsdata/barchart_jagungpipilankering',  function(Request $request){
			$compModel = new App\Models\ComponentsData();
			return $compModel->barchart_jagungpipilankering($request);
		}
	);
		
	Route::get('componentsdata/barchart_ubikayu',  function(Request $request){
			$compModel = new App\Models\ComponentsData();
			return $compModel->barchart_ubikayu($request);
		}
	);
		
	Route::get('componentsdata/barchart_ubijalar',  function(Request $request){
			$compModel = new App\Models\ComponentsData();
			return $compModel->barchart_ubijalar($request);
		}
	);
		
	Route::get('componentsdata/barchart_kedelailokalkering',  function(Request $request){
			$compModel = new App\Models\ComponentsData();
			return $compModel->barchart_kedelailokalkering($request);
		}
	);
		
	Route::get('componentsdata/barchart_cabebesar',  function(Request $request){
			$compModel = new App\Models\ComponentsData();
			return $compModel->barchart_cabebesar($request);
		}
	);
		
	Route::get('componentsdata/barchart_caberawitmerah',  function(Request $request){
			$compModel = new App\Models\ComponentsData();
			return $compModel->barchart_caberawitmerah($request);
		}
	);
		
	Route::get('componentsdata/barchart_cabekeriting',  function(Request $request){
			$compModel = new App\Models\ComponentsData();
			return $compModel->barchart_cabekeriting($request);
		}
	);
		
	Route::get('componentsdata/barchart_bawangmerah',  function(Request $request){
			$compModel = new App\Models\ComponentsData();
			return $compModel->barchart_bawangmerah($request);
		}
	);
		
	Route::get('componentsdata/barchart_dagingayam',  function(Request $request){
			$compModel = new App\Models\ComponentsData();
			return $compModel->barchart_dagingayam($request);
		}
	);
		
	Route::get('componentsdata/barchart_dagingsapi',  function(Request $request){
			$compModel = new App\Models\ComponentsData();
			return $compModel->barchart_dagingsapi($request);
		}
	);
		
	Route::get('componentsdata/barchart_telurayamras',  function(Request $request){
			$compModel = new App\Models\ComponentsData();
			return $compModel->barchart_telurayamras($request);
		}
	);
		
	Route::get('componentsdata/barchart_pisang',  function(Request $request){
			$compModel = new App\Models\ComponentsData();
			return $compModel->barchart_pisang($request);
		}
	);
		
	Route::get('componentsdata/barchart_jeruk',  function(Request $request){
			$compModel = new App\Models\ComponentsData();
			return $compModel->barchart_jeruk($request);
		}
	);
		
	Route::get('componentsdata/getcount_hargaprodusen',  function(Request $request){
			$compModel = new App\Models\ComponentsData();
			return $compModel->getcount_hargaprodusen($request);
		}
	);
		
	Route::get('componentsdata/getcount_publikasipangan',  function(Request $request){
			$compModel = new App\Models\ComponentsData();
			return $compModel->getcount_publikasipangan($request);
		}
	);
});


Route::post('fileuploader/upload/{fieldname}', 'FileUploaderController@upload');
Route::post('fileuploader/s3upload/{fieldname}', 'FileUploaderController@s3upload');
Route::post('fileuploader/remove_temp_file', 'FileUploaderController@remove_temp_file');


/**
 * All static content routes
 */
Route::get('info/about',  function(){
		return view("pages.info.about");
	}
);
Route::get('info/faq',  function(){
		return view("pages.info.faq");
	}
);

Route::get('info/contact',  function(){
	return view("pages.info.contact");
}
);
Route::get('info/contactsent',  function(){
	return view("pages.info.contactsent");
}
);

Route::post('info/contact',  function(Request $request){
		$request->validate([
			'name' => 'required',
			'email' => 'required|email',
			'message' => 'required'
		]);

		$senderName = $request->name;
		$senderEmail = $request->email;
		$message = $request->message;

		$receiverEmail = config("mail.from.address");

		Mail::send(
			'pages.info.contactemail', [
				'name' => $senderName,
				'email' => $senderEmail,
				'comment' => $message
			],
			function ($mail) use ($senderEmail, $receiverEmail) {
				$mail->from($senderEmail);
				$mail->to($receiverEmail)
					->subject('Contact Form');
			}
		);
		return redirect("info/contactsent");
	}
);


Route::get('info/features',  function(){
		return view("pages.info.features");
	}
);
Route::get('info/privacypolicy',  function(){
		return view("pages.info.privacypolicy");
	}
);
Route::get('info/termsandconditions',  function(){
		return view("pages.info.termsandconditions");
	}
);

Route::get('info/changelocale/{locale}', function ($locale) {
	app()->setlocale($locale);
	session()->put('locale', $locale);
    return redirect()->back();
})->name('info.changelocale');
