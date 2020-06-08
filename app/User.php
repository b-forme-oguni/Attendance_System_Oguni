<?php

namespace App;

use App\School;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    // ソフトデリートを実装
    use SoftDeletes;
    // テーブル名を明示的に指定（なくても複数形のusersのまま）
    protected $table = 'users';
    // AIなど、入力から除外するカラムを指定
    protected $guarded = array('id');
    // 日付ミューテタを適用させるカラムを指定（Carbonクラスにキャストされる）
    protected $dates = [
        'deleted_at'
    ];

    // バリデータールールを指定
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

    //hasMany設定
    public function performance()
    {
        return $this->hasMany('App\Peformance');
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
