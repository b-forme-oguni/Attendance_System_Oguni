<?php

namespace App\Http\Controllers;

use App\User;
use App\School;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class StampController extends Controller
{

    const  KANA = array(
        'ア' => '[ア-オ]',
        'カ' => '[カ-コ ガ-ゴ]',
        'サ' => '[サ-ソ ザ-ゾ]',
        'タ' => '[タ-ト ダ-ド]',
        'ナ' => '[ナ-ノ]',
        'ハ' => '[ハ-ホ バ-ボ パ-ポ]',
        'マ' => '[マ-モ]',
        'ヤ' => '[ヤ-ヨ]',
        'ラ' => '[ラ-ロ]',
        'ワ' => '[ワ-ン]',
    );

    public function all($id)
    {
        $school =  School::idEqual($id)->first();


        Carbon::setLocale('ja');
        $dt = new \Carbon\Carbon();
        $today = $dt->isoFormat('YYYY年MM月DD日（ddd）');


        $users =  User::schoolIdEqual($id)
            ->orderBy('last_name_kana')->get();

        $prame = [
            'school' => $school,
            'users' => $users,
            'kanalist' => self::KANA,
            'today' => $today,
        ];
        return view('user.stamp', $prame);
    }

    public function kanaSelect(Request $request, $id)
    {
        $school =  School::idEqual($id)->first();
        $users =  User::schoolIdEqual($id)
            ->orderBy('last_name_kana')->get();

        $prame = [
            'school' => $school,
            'users' => $users,
        ];
        return view('user.stamp', $prame);
    }
}
