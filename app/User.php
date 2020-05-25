<?php

namespace App;

use App\School;
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

    public function scopeSchoolIdEqual($query, $int)
    {
        return $query->where('school_id', $int);
    }

    public function school()
    {
        return $this->belongsTo('App\School');
    }

    public function getName()
    {
        return $this->last_name . '　' . $this->first_name;
    }

    public function getNameKana()
    {
        return $this->last_name_kana . '　' . $this->first_name_kana;
    }


}
