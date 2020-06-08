<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';
    protected $guarded = array('id');

    //hasMany設定
    public function performance()
    {
    return $this->hasMany('App\Peformance');
    }

}
