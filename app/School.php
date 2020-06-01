<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'schools';
    protected $guarded = array('id');

    public function scopeIdEqual($query, $int)
    {
        return $query->where('id', $int);
    }

    public function getName()
    {
        return $this->school_name;
    }
}
