<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'schools';
    protected $guarded = array('id');
    
    public function getSchoolName()
    {
        return $this->school_name;
    }
}
