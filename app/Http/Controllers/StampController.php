<?php

namespace App\Http\Controllers;

use App\User;
use App\School;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class StampController extends Controller
{

    const  KANA = array(
        // 五十音を解列で格納
        'ア' => ['ア', 'イ', 'ウ', 'エ', 'オ'],
        'カ' => ['カ', 'ガ', 'キ', 'ギ', 'ク', 'グ', 'ケ', 'ゲ', 'コ', 'ゴ'],
        'サ' => ['サ', 'ザ', 'シ', 'ジ', 'ス', 'ズ', 'セ', 'ゼ', 'ソ', 'ゾ'],
        'タ' => ['タ', 'ダ', 'チ', 'ヂ', 'ツ', 'ヅ', 'テ', 'デ', 'ト', 'ド'],
        'ナ' => ['ナ', 'ニ', 'ヌ', 'ネ', 'ノ'],
        'ハ' => ['ハ', 'ヒ', 'フ', 'ヘ', 'ホ', 'バ', 'ビ', 'ブ', 'ベ', 'ボ', 'パ', 'ピ', 'プ', 'ペ', 'ポ'],
        'マ' => ['マ', 'ミ', 'ム', 'メ', 'モ'],
        'ヤ' => ['ヤ', 'ユ', 'ヨ'],
        'ラ' => ['ラ', 'リ', 'ル', 'レ', 'ロ'],
        'ワ' => ['ワ', 'ヲ', 'ン'],
    );

    public function stamp(Request $request, $id)
    {
        $school =  School::idEqual($id)->first();

        Carbon::setLocale('ja');
        $dt = new \Carbon\Carbon();
        $today = $dt->isoFormat('YYYY年MM月DD日（ddd）');

        $index = $request->index;
        if ($index) {
            // クエリ文字をキーとしてSQL文を生成
            $kanaindex = self::KANA[$index];
            $param = '';
            for ($i = 0; $i < count($kanaindex); $i++) {
                if ($i == count($kanaindex) - 1) {
                    $param .= '"' . $kanaindex[$i] . '"';
                } else {
                    $param .= '"' . $kanaindex[$i] . '", ';
                }
            }
            $sqltxt = 'left(last_name_kana, 1) in (' . $param . ')';
            // 指定行のユーザーのみ表示
            $users = User::schoolIdEqual($id)
                ->whereRaw($sqltxt)
                ->orderBy('last_name_kana')
                ->get();
        } else {
            // 全てのユーザーを表示
            $users =  User::schoolIdEqual($id)
                ->orderBy('last_name_kana')->get();
        }

        $prame = [
            'school' => $school,
            'users' => $users,
            'kanalist' => self::KANA,
            'today' => $today,
        ];
        return view('user.stamp', $prame);
    }
}
