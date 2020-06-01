<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $table = 'performances';
    protected $guarded = array('id');

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function note()
    {
        return $this->belongsTo('App\Note');
    }

    public function getFlag($bool)
    {
        if ($bool) {
            return '○';
        } else {
            return '×';
        }
    }

    public function getNote()
    {
        if ($this->note_id) {
            return $this->note->note;
        } else {
            return '―';
        }
    }


}
