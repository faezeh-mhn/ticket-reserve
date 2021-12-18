<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

class BusRequest extends FormRequest
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
        $rules = [
            'plate_number' => 'unique:buses|required|integer',
            'type' => 'required',
            'capacity' => 'required|integer',
        ];
        return $rules;
    }

//    public function failedValidation(Validator $validator)
//    {
//        $errors = $validator->errors(); // Here is your array of errors
//        throw new HttpResponseException($errors);
//    }
}
