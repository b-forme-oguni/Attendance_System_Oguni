<?php

namespace App\Http\Validators;

use App\Performance;
use Illuminate\Validation\Validator;

class FormValidator extends Validator
{

    public function validatePerformance($attribute, $value, $parameters)
    {

        $insert_date = $this->data['insert_date'];
        $user_id = $this->data['user_id'];

        $performance = new Performance;

        // 実績記録の変更で、日付・利用者を変更せずに内容を更新した場合
        if (isset($this->data['id'])) {
            $id = $this->data['id'];
            $record = $performance->where('id', $id)->first();
            if ($record->insert_date == $insert_date && $record->user_id == $user_id) {
                return true;
            }
        }

        // 実績記録が新規登録、または変更で日付か利用者が変更された場合
        $record = $performance->where('insert_date', '=', $insert_date)
            ->where('user_id', '=', $user_id)->first();
        if (is_null($record)) {
            return true;
        }
        return false;
    }

    public function validateStartendtime($attribute, $value, $parameters)
    {
        // バリデーションインスタンスからstartの値を取得
        $start = date("H:i", strtotime($this->data['start']));
        // バリデーションインスタンスからendの値を取得
        // endが入力されていない場合は、true
        if (isset($this->data['end'])) {
            $end = date("H:i", strtotime($this->data['end']));
        } else {
            return true;
        }

        // start時刻がend時刻以下の場合のみ、true
        if ($start < $end) {
            return true;
        }
        return false;
    }
}
