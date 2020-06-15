<?php
namespace App\Http\Validators;

use App\Performance;
use Illuminate\Validation\Validator;

class FormValidator extends Validator {
    public function validateInsertDate($attribute, $value, $parameters){
        $record = Performance::where('insert_date', '=', $value)
        ->where('user_id', '=', )
    }
}
