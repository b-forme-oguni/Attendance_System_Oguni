<?php
namespace App\Http\Validators;

use App\Performance;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class FormValidator extends Validator {

    public function validateForm($attribute, $value, $parameters){
        $insert_date = $this->data['insert_date'];
        $user_id = $this->data['user_id'];
        $record = Performance::where('insert_date', '=', $insert_date)
        ->where('user_id', '=', $user_id)->first();
        return is_null($record);
    }
}
