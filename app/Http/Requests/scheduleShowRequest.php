<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class scheduleShowRequest extends FormRequest
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
        return [  'destination' => 'required|string',
            'starting_point' => 'required|string',
            'departure_date' => 'required|date_format:Y-m-d',
            'most_expensive' => 'boolean',
            'cheapest' => 'boolean',
            'earliest' => 'boolean',
            'latest' => 'boolean',
            'type' => 'string'

        ];
    }
}
