<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HargaProdusenEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
		
        return [
            
				"tanggal" => "filled|date",
				"gkp_petani" => "filled|numeric",
				"gkg_penggilingan" => "filled|numeric",
				"beras_premium" => "filled|numeric",
				"beras_medium" => "filled|numeric",
				"jagung_pipilan_kering" => "filled|numeric",
				"cabe_besar" => "filled|numeric",
				"cabe_rawit_merah" => "filled|numeric",
				"cabe_keriting" => "filled|numeric",
				"bawang_merah" => "filled|numeric",
				"daging_ayam" => "filled|numeric",
				"daging_sapi" => "filled|numeric",
				"telur_ayam_ras" => "filled|numeric",
				"pisang" => "filled|numeric",
				"jeruk" => "filled|numeric",
				"ubi_kayu" => "filled|numeric",
				"ubi_jalar" => "filled|numeric",
				"kedelai_lokal_kering" => "filled|numeric",
            
        ];
    }

	public function messages()
    {
        return [
			
            //using laravel default validation messages
        ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [
            //eg = 'name' => 'trim|capitalize|escape'
        ];
    }
}
