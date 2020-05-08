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

        // 五十音をSQL用の文字列で格納
        // 'ア' => '"ア", "イ", "ウ", "エ", "オ"',
        // 'カ' => '"カ", "ガ", "キ", "ギ", "ク", "グ", "ケ", "ゲ", "コ", "ゴ"',
        // 'サ' => '"サ", "ザ", "シ", "ジ", "ス", "ズ", "セ", "ゼ", "ソ", "ゾ"',
        // 'タ' => '"タ", "ダ", "チ", "ヂ", "ツ", "ヅ", "テ", "デ", "ト", "ド"',
        // 'ナ' => '"ナ", "ニ", "ヌ", "ネ", "ノ"',
        // 'ハ' => '"ハ", "ヒ", "フ", "ヘ", "ホ", "バ", "ビ", "ブ", "ベ", "ボ", "パ", "ピ", "プ", "ペ", "ポ"',
        // 'マ' => '"マ", "ミ", "ム", "メ", "モ"',
        // 'ヤ' => '"ヤ", "ユ", "ヨ"',
        // 'ラ' => '"ラ", "リ", "ル", "レ", "ロ"',
        // 'ワ' => '"ワ", "ヲ", "ン"',

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

        $index = $request->index;


        Carbon::setLocale('ja');
        $dt = new \Carbon\Carbon();
        $today = $dt->isoFormat('YYYY年MM月DD日（ddd）');

        if ($index) {

            $kanaindex = self::KANA[$index];
            $param = '';
            foreach ($kanaindex as $is) {
                $param .= '?,';
            }

            $users =  User::schoolIdEqual($id)

                // ①【正常動作】リテラルなSQL文
                // ->whereRaw('left(last_name_kana, 1) in ("ア", "イ", "ウ", "エ", "オ")')

                // ②【エラー】"ア", "イ", "ウ", "エ", "オ"の入った配列数と、？の数が合致すれば動作する
                // ->whereRaw('left(last_name_kana, 1) in (?,?,?,?,?)', [$kanaindex])

                // ③【エラー】？の数を配列数分くりかえして挿入。パラメーターはバインドしているが動作しない
                ->whereRaw('left(last_name_kana, 1) in (' . $param . ')', [$kanaindex])

                // ④【思った動作をしない】whereIn() では、left(last_name_kana, 1)を指定できない
                // ->whereIn('last_name_kana', self::KANA[urldecode($index)])

                ->orderBy('last_name_kana')->get();
        } else {
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
