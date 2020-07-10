<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'last_name' => 'required',
            'first_name' => 'required',
            'last_name_kana' => [
                'required',
                'regex:/^[ア-ンァ-ォャ-ョー！-／：-＠［-｀｛-～、-〜”’・\x20　]+$/u',
            ],
            'first_name_kana' => [
                'required',
                'regex:/^[ア-ンァ-ォャ-ョー！-／：-＠［-｀｛-～、-〜”’・\x20　]+$/u',
            ],
            'school_id' => 'required | integer',
        ];
    }
    public function messages()
    {
        return [
            'last_name.required' => '姓を入力して下さい',
            'first_name.required' => '名を入力して下さい',
            'last_name_kana.required' => '姓（カナ）を入力して下さい',
            'first_name_kana.required' => '名（カナ）を入力して下さい',
            'last_name_kana.regex' => 'カタカタで入力して下さい',
            'first_name_kana.regex' => 'カタカタで入力して下さい',
        ];
    }
}
