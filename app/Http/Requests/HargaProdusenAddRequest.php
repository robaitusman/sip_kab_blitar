<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HargaProdusenAddRequest extends FormRequest
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
            
				"tanggal" => "required|date",
				"gkp_petani" => "required|numeric",
				"gkg_penggilingan" => "required|numeric",
				"beras_premium" => "required|numeric",
				"beras_medium" => "required|numeric",
				"jagung_pipilan_kering" => "required|numeric",
				"cabe_besar" => "required|numeric",
				"cabe_rawit_merah" => "required|numeric",
				"cabe_keriting" => "required|numeric",
				"bawang_merah" => "required|numeric",
				"daging_ayam" => "required|numeric",
				"daging_sapi" => "required|numeric",
				"telur_ayam_ras" => "required|numeric",
				"pisang" => "required|numeric",
				"jeruk" => "required|numeric",
				"ubi_kayu" => "required|numeric",
				"ubi_jalar" => "required|numeric",
				"kedelai_lokal_kering" => "required|numeric",
            
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
