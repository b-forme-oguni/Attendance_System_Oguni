<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';
    protected $guarded = array('id');

    //従キーを設定
    public function performance()
    {
        return $this->hasMany('App\Peformance');
    }

}
