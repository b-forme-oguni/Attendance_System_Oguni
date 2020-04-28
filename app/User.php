<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $guarded = array('id');

    public static $rulse = array(
        'last_name' => 'required',
        'first_name' => 'required',
        'last_name_kana' => 'required',
        'first_name_kana' => 'required',
        'school_id' => 'required | integer',
    );

    public function getUserName()
    {
        return $this->last_name . '　' . $this->first_name;
    }

    public function getUserNameKana()
    {
        return $this->last_name_kana . '　' . $this->first_name_kana;
    }
}
