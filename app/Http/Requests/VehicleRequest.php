<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            'created' => 'required|date',
            'updated' => 'required|date',
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

    public function messages()
    {
        return [
            'json_data_id.required' => 'O campo json_data_id é obrigatório.',
            'json_data_id.integer'  => 'O campo json_data_id deve ser um número.',
            'type.required'         => 'O campo type é obrigatório.',
            'brand.required'        => 'O campo brand é obrigatório.',
            'model.required'        => 'O campo model é obrigatório.',
            'version.required'     => 'O campo version é obrigatório.',
            'doors.required'        => 'O campo doors é obrigatório.',
            'board.required'        => 'O campo board é obrigatório.',
            'chassi.string'         => 'O campo chassi deve ser uma string.',
            'transmission.required' => 'O campo transmission é obrigatório.',
            'km.required'           => 'O campo km é obrigatório.',
            'description.string'    => 'O campo description deve ser uma string.',
            'created.required' => 'O campo created é obrigatório.',
            'updated.required' => 'O campo updated é obrigatório.',
            'sold.boolean'          => 'O campo sold deve ser verdadeiro ou falso.',
            'category.required'     => 'O campo category é obrigatório.',
            'url_car.required'      => 'O campo url_car é obrigatório.',
            'old_price.numeric'     => 'O campo old_price deve ser um número.',
            'old_price.min'         => 'O campo old_price deve ser pelo menos 0.',
            'price.required'       => 'O campo price é obrigatório.',
            'price.numeric'        => 'O campo price deve ser um número.',
            'price.min'            => 'O campo price deve ser pelo menos 0.',
            'color.required'       => 'O campo color é obrigatório.',
            'fuel.required'        => 'O campo fuel é obrigatório.',
            'year.required'       => 'O campo year é obrigatório.',
            'year.json'           => 'O campo year deve ser um JSON válido.',
            'optionals.required'  => 'O campo optionals é obrigatório.',
            'optionals.json'      => 'O campo optionals deve ser um JSON válido.',
            'fotos.required'      => 'O campo fotos é obrigatório.',
            'fotos.json'          => 'O campo fotos deve ser um JSON válido.',
        ];
    }

    public function failedValidation(Validator $validator){
        $errors = $validator->errors();

        throw new HttpResponseException(response()->json([
            'success' => false,
            'errors' => $errors,
        ], 422));
    }
}
