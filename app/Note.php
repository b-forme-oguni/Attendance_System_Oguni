<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';
    protected $guarded = array('id');

    public function getSchoolName()
    {
        return $this->note;
    }
}
