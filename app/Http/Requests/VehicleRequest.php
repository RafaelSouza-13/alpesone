<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Vehicle;

class VehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(){
        return [
            'json_data_id' => 'required|integer',
            'type'         => 'required|string',
            'brand'        => 'required|string',
            'model'        => 'required|string',
            'version'      => 'required|string',
            'doors'        => 'required|string',
            'board'        => 'required|string',
            'chassi'       => 'nullable|string',
            'transmission' => 'required|string',
            'km'           => 'required|string',
            'description'  => 'nullable|string',
            'created_json' => 'required|date',
            'updated_json' => 'required|date',
            'sold'         => 'boolean',
            'category'     => 'required|string|max:100',
            'url_car'      => 'required|string',
            'old_price'    => 'nullable|numeric|min:0',
            'price'        => 'required|numeric|min:0',
            'color'        => 'required|string',
            'fuel'         => 'required|string',
            'year'         => 'required|json',
            'optionals'    => 'required|json',
            'fotos'        => 'required|json',
        ];
    }
}
