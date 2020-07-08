<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Session;
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
            'insert_date' => 'required|performance',
            'start' => 'required|startendtime',
            'user_id' => 'required',
            'food_fg' => 'required',
            'outside_fg' => 'required',
            'medical_fg' => 'required',
            'note_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'insert_date.performance' => '既に同日にその利用者の実績記録が存在しています。日付か利用者を変更して下さい',
            'user_id.required' => '利用者を選択して下さい',
            'start.startendtime' => '開始時刻は終了時刻より以前にして下さい',
        ];
    }

    protected function getRedirectUrl()
    {
        // リダイレクト直前にセッションを継続
        Session::reflash();
        return url()->previous();
    }
}
