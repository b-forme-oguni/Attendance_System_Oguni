<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $table = 'performances';
    protected $guarded = array('id');
    // 日付ミューテタを適用させるカラムを指定（Carbonクラスにキャストされる）
    protected $times = [
        'start',
        'end',
    ];

    public function user()
    {
        return $this->belongsTo('App\User')->with('school');
    }

    public function note()
    {
        return $this->belongsTo('App\Note');
    }

    public function school()
    {
        return $this->belongsTo('App\School');
    }

    public function getFlag($bool)
    {
        if ($bool) {
            return '○';
        } else {
            return '―';
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

    public function scopeSchoolIdEqual($query, $int)
    {
        return $query->where('school_id', $int);
    }

    public function getStartAttribute($value, $margin_minutes = 15)
    {
        $_hour = date('H', strtotime($value));
        $_minute = date('i', strtotime($value));

        if ($_minute % $margin_minutes) {
            $_minute += $margin_minutes - ($_minute % $margin_minutes);
        }

        return date('H:i', mktime($_hour, $_minute, 0));
    }


    public function getEndAttribute($value, $margin_minutes = 15)
    {
        $_hour = date('H', strtotime($value));
        $_minute = date('i', strtotime($value));

        if (is_null($value)) {
            return $value;
        }elseif ( $_hour >= 16 ) {
            $_hour = 16;
            $_minute = 0;
        } elseif ($_minute % $margin_minutes) {
            $_minute -= ($_minute % $margin_minutes);
        }

        return date('H:i', mktime($_hour, $_minute, 0));
    }
}
