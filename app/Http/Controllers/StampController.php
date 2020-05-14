<?php

namespace App\Http\Controllers;

use App\Performance;
use App\User;
use App\School;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class StampController extends Controller
{

    // 五十音を解列で格納
    const  KANA = array(
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

    //打刻画面表示
    public function stamp(Request $request, $school_id)
    {
        $school =  School::idEqual($school_id)->first();

        // 日付を曜日付きで表示
        Carbon::setLocale('ja');
        $dt = new \Carbon\Carbon();
        $today = $dt->isoFormat('YYYY年MM月DD日（ddd）');

        // 利用者リストを学校idでスコープ
        $userslist = User::schoolIdEqual($school_id)->get();

        //利用者の出席状態を連想配列で記録
        $attendlist = array();
        foreach ($userslist as $user) {
            $timestamp = Performance::where('user_id', $user->id)->latest()->first();
            if ($timestamp) {
                $oldTimestampDay = $timestamp->insert_date;
                $newTimestampDay = Carbon::now()->toDateString();
                if (($oldTimestampDay == $newTimestampDay)) {
                    if (!$timestamp->end) {
                        $attendlist[$user->id] = true;
                    } else {
                        $attendlist[$user->id] = false;
                    }
                }
            }
        }

        // 利用者リストを学校idでスコープ
        $userstable = User::schoolIdEqual($school_id);

        // 利用者リストを目次で絞る
        $index = $request->index;
        if ($index) {
            // 指定行のユーザーのみ表示
            $kanaindex = self::KANA[$index];
            $initial = '';
            for ($i = 0; $i < count($kanaindex); $i++) {
                if ($i == count($kanaindex) - 1) {
                    $initial .= '"' . $kanaindex[$i] . '"';
                } else {
                    $initial .= '"' . $kanaindex[$i] . '", ';
                }
            }
            $sqltxt = 'left(last_name_kana, 1) in (' . $initial . ')';
            $users = $userstable
                ->whereRaw($sqltxt)
                ->orderBy('last_name_kana')
                ->get();
        } else {
            // 全てのユーザーを表示
            $users = $userstable
                ->orderBy('last_name_kana')
                ->get();
        }

        $prame = [
            'school' => $school,
            'today' => $today,
            'users' => $users,
            'kanalist' => self::KANA,
            'attendlist' =>  $attendlist,
        ];

        // 利用者名を表示
        if ($request->id) {
            $personal = User::where('id', $request->id)->first();
            $prame['personal'] = $personal;
        } else {
            $alerttxt = '右リストから利用者名を選択して下さい';
            $prame['alerttxt'] = $alerttxt;
        }

        return view('user.stamp', $prame);
    }

    //開始打刻
    public function start(Request $request, $school_id)
    {
        //利用者の前回のレコードがあれば、最終打刻の日付を取得
        $oldTimestamp = Performance::where('user_id', $request->user_id)->latest()->first();
        if ($oldTimestamp) {
            $oldTimestampDay = $oldTimestamp->insert_date;
        } else {
            $oldTimestampDay = '';
        }

        //当日2回目の打刻は行わない
        $newTimestampDay = Carbon::now()->toDateString();
        if (($oldTimestampDay == $newTimestampDay)) {
            return  redirect('stamp/' . $school_id);
        }

        //当日のレコードを作成
        $timestamp = Performance::create([
            'user_id' => $request->user_id,
            'insert_date' => $newTimestampDay,
            'start' => Carbon::now()->toTimeString(),
        ]);

        return  redirect('stamp/' . $school_id);
    }

    //終了打刻
    public function end(Request $request, $school_id)
    {
        //終了打刻がまだであれば、レコードに終了時刻を追加変更
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
