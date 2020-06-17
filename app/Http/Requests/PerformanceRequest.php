<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class PerformanceRequest extends FormRequest
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
            'insert_date' => 'required|form',
            'start' => 'required',
            'end' => 'required',
            'user_id' => 'required',
            'food_fg' => 'required',
            'outside_fg' => 'required',
            'medical_fg' => 'required',
            'note_id' => 'required',
        ];
    }
}
