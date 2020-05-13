<?php

namespace App\Http\Controllers;

use App\Performance;
use App\User;
use App\School;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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

    public function stamp(Request $request, $school_id)
    {
        $school =  School::idEqual($school_id)->first();

        // 日付を曜日付きで表示
        Carbon::setLocale('ja');
        $dt = new \Carbon\Carbon();
        $today = $dt->isoFormat('YYYY年MM月DD日（ddd）');

        // 利用者リストを目次で絞る
        $index = $request->index;
        if ($index) {
            // 指定行のユーザーのみ表示
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
            $users = User::schoolIdEqual($school_id)
                ->whereRaw($sqltxt)
                ->orderBy('last_name_kana')
                ->get();
        } else {
            // 全てのユーザーを表示
            $users =  User::schoolIdEqual($school_id)
                ->orderBy('last_name_kana')->get();
        }

        // 利用者名を表示
        if ($request->id) {
            $personal = User::where('id', $request->id)->first();
        } else {
            $personal = '';
        }

        $prame = [
            'school' => $school,
            'today' => $today,
            'users' => $users,
            'personal' => $personal,
            'kanalist' => self::KANA,
        ];
        return view('user.stamp', $prame);
    }

    public function start(Request $request, $school_id)
    {

        $oldTimestamp = Performance::where('user_id', $request->user_id)->latest()->first();
        if ($oldTimestamp) {
            $oldTimestampDay = $oldTimestamp->insert_date;
        } else {
            $oldTimestampDay = '';
        }

        $newTimestampDay = Carbon::now()->toDateString();
        if (($oldTimestampDay == $newTimestampDay)) {
            return  redirect('stamp/' . $school_id);
        }

        $timestamp = Performance::create([
            'user_id' => $request->user_id,
            'insert_date' => $newTimestampDay,
            'start' => Carbon::now()->toTimeString(),
        ]);

        return  redirect('stamp/' . $school_id);
    }


    public function end(Request $request, $school_id)
    {

        $timestamp = Performance::where('user_id', $request->user_id)->latest()->first();


        if (!empty($timestamp->end)) {
            return  redirect('stamp/' . $school_id);
        }


        $timestamp->update([
            'end' => Carbon::now()->toTimeString(),
        ]);

        return  redirect('stamp/' . $school_id);
    }
}
