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

    // ローカルスコープを設定
    public function scopeSchoolIdEqual($query, $int)
    {
        return $query->where('school_id', $int);
    }
    // 主キーとのリレーション
    public function school()
    {
        return $this->belongsTo('App\School');
    }

    // 従キーとのリレーション
    public function performance()
    {
        return $this->hasMany('App\Peformance');
    }

    // フルネームを表示（姓名の間にスペースを挿入）
    public function getName()
    {
        return $this->last_name . '　' . $this->first_name;
    }
    // フルネームを表示
    public function getNameFull()
    {
        return $this->last_name . $this->first_name;
    }
    // カナ名フルネームを表示（姓名の間にスペースを挿入）
    public function getNameKana()
    {
        return $this->last_name_kana . '　' . $this->first_name_kana;
    }
}
