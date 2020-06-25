<?php

namespace App;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    // テーブル名を明示的に指定（なくても複数形のperformancesのまま）
    protected $table = 'performances';
    // AIなど、入力から除外するカラムを指定
    protected $guarded = array('id');

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

    // GETメソッド
    public function getStart()
    {
        if ($this->start) {
            return $this->start;
        } else {
            return '-';
        }
    }
    public function getEnd()
    {
        if ($this->end) {
            return $this->end;
        } else {
            return '-';
        }
    }
    public function getFlagsign($bool)
    {
        if ($bool) {
            return '○';
        } else {
            return '-';
        }
    }

    public function scopeDateIdEqual($query, $string)
    {
        return $query->where('insert_date', $string);
    }

    // startカラムに時間を15分切り上げるアクセサを設定する
    public function getStartAttribute($value, $margin_minutes = 15)
    {
        $_hour = date('H', strtotime($value));
        $_minute = date('i', strtotime($value));
        if ($_minute % $margin_minutes) {
            $_minute += $margin_minutes - ($_minute % $margin_minutes);
        }
        return date('H:i', mktime($_hour, $_minute, 0));
    }

    // endカラムにアクセサを設定する
    public function getEndAttribute($value, $margin_minutes = 15)
    {
        // endカラムがNULLの場合
        if (is_null($value)) {
            $dt = Carbon::now();
            $t = function ($h, $m) {
                return Carbon::createFromTime($h, $m, 0);
            };
            // レコードが当日で且つ16時まではNULLのまま
            if ($dt->toDateString() == $this->insert_date && $dt->between($t(0, 0), $t(16, 00))) {
                return $value;
            } else {
                // 終了打刻がないまま16時を過ぎた場合、16時に打刻されたことになる
                $_hour = 16;
                $_minute = 0;
            }
            // endカラムに終了時刻が打刻された場合
        } else {
            // endカラムの時間を15分切り下げる
            $_hour = date('H', strtotime($value));
            $_minute = date('i', strtotime($value));
            if ($_minute % $margin_minutes) {
                $_minute -= ($_minute % $margin_minutes);
            }
        }
        return date('H:i', mktime($_hour, $_minute, 0));
    }

}
