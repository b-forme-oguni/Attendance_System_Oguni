<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'schools';
    protected $guarded = array('id');

    public function user()
    {
        return $this->hasMany('App\User');
    }

    public function scopeIdEqual($query, $int)
    {
        return $query->where('id', $int);
    }

    public function getName()
    {
        return $this->school_name;
    }
}
