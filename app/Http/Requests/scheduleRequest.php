<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class scheduleRequest extends FormRequest
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
            'startingpoint' => 'required',
            'destination' => 'required',
            'departuretime' => 'required',
            'arrivaltime' => 'required',
            'fare' => 'required',
            'platenumber' => 'required',
            'contactdriver' => 'required',////replace id of driver
            'departuredate' => 'required',
            'arrivaldate' => 'required'
        ];
    }
}
