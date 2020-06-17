<?php
namespace App\Http\Validators;

use App\Performance;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class FormValidator extends Validator {

    public function validateForm($attribute, $value, $parameters){
        $record = Performance::where('insert_date', '=', $value)
        ->where('user_id', '=', Request::input('user_id'))->latest()->first();
        return is_null($record);
    }
}
