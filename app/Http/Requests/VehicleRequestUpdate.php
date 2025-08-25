<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class VehicleRequestUpdate extends FormRequest
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
            'id' => 'required|integer',
            'type'     => 'sometimes|string',
            'brand'    => 'sometimes|string',
            'model'    => 'sometimes|string',
            'version'  => 'sometimes|string',
            'doors'    => 'sometimes|integer|min:2',
            'board'    => 'sometimes|string',
            'chassi'   => 'nullable|string',
            'transmission' => 'sometimes|string',
            'km'           => 'sometimes|string',
            'description'  => 'nullable|string',
            'created' => 'sometimes|date',
            'updated' => 'sometimes|date',
            'sold'         => 'boolean',
            'category'     => 'sometimes|string|max:100',
            'url_car'      => 'sometimes|string',
            'old_price'    => 'nullable|numeric|min:0',
            'price'        => 'sometimes|numeric|min:0',
            'color'        => 'sometimes|string',
            'fuel'         => 'sometimes|string',
            'year'         => 'sometimes|array',
            'optionals'    => 'sometimes|array',
            'fotos'        => 'sometimes|array',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'O campo id é obrigatório.',
            'id.integer'  => 'O campo id deve ser um número.',
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
