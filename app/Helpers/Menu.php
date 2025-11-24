
<?php
	class Menu{
		
	public static function navbarsideleft(){
		return [
		[
			'path' => 'home',
			'label' => "Home", 
			'icon' => '<i class="material-icons ">home</i>'
		],
		
		[
			'path' => 'datapangan',
			'label' => "Data Pangan", 
			'icon' => '<i class="material-icons ">assignment</i>'
		],
		
		[
			'path' => 'kecamatan',
			'label' => "Kecamatan", 
			'icon' => '<i class="material-icons ">location_city</i>'
		],
		
		[
			'path' => 'nbm',
			'label' => "Nbm", 
			'icon' => '<i class="material-icons ">storage</i>'
		],
		
		[
			'path' => 'publikasipangan',
			'label' => "Publikasi Pangan", 
			'icon' => '<i class="material-icons ">cloud_upload</i>'
		],
		
		[
			'path' => 'users',
			'label' => "Users", 
			'icon' => '<i class="material-icons ">person</i>'
		],
		
		[
			'path' => 'roles',
			'label' => "Roles", 
			'icon' => '<i class="material-icons ">person_pin</i>'
		],
		
		[
			'path' => 'hargaprodusen',
			'label' => "Harga Produsen", 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'hargaprodusen/harga_produsen_saya',
			'label' => "Harga Produsen", 
			'icon' => '<i class="material-icons ">shopping_cart</i>'
		]
	] ;
	}
	
		
	public static function bulan(){
		return [
		[
			'value' => '1', 
			'label' => "January", 
		],
		[
			'value' => '2', 
			'label' => "February", 
		],
		[
			'value' => '3', 
			'label' => "Maret", 
		],
		[
			'value' => '4', 
			'label' => "April", 
		],
		[
			'value' => '5', 
			'label' => "Mei", 
		],
		[
			'value' => '6', 
			'label' => "Juni", 
		],
		[
			'value' => '7', 
			'label' => "Juli", 
		],
		[
			'value' => '8', 
			'label' => "Agustus", 
		],
		[
			'value' => '9', 
			'label' => "September", 
		],
		[
			'value' => '10', 
			'label' => "Oktober", 
		],
		[
			'value' => '11', 
			'label' => "November", 
		],
		[
			'value' => '12', 
			'label' => "Desember", 
		],] ;
	}
	
	}
