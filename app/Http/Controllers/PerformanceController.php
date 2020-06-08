<?php

namespace App\Http\Controllers;

use App\User;
use App\School;
use App\Performance;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    public function index(Request $request, $school_id)
    {
        $schools =  School::all();

        if (empty($school_id)) {
            // リレーション先の条件で検索を行う（所属校）
            $records = Performance::has('user')->latest()->with(['user', 'note'])->paginate(10);
        } else {
            // リレーション先の条件で検索を行う（所属校）
            $records = Performance::has('user')->whereHas('User', function ($q) use ($school_id) {
                $q->where('school_id', $school_id);
            })
                ->latest()->with(['user', 'note'])->paginate(10);
        }

        $param = [
            'records' => $records,
            'schools' => $schools,
            'school_id' =>  $school_id,
        ];
        return view('admin.performance_record', $param);
    }


    // 実績記録変更画面
    public function edit(Request $request)
    {
        // クエリから指定したidのレコードを取得
        $record = Performance::where('id', $request->id)->first();

        // Formファザード用にUserクラスをidと名前の連想配列にする
        $users = User::all();
        $userslist = [];
        foreach ($users as $user) {
            $userslist += [
                $user->id => $user->id . '：' . $user->getName(),
            ];
        }


        $timetable = [];
        for ($i = 9 * 4; $i <= 16 * 4; $i++) {
            if ($i <= 16 * 3) {
                $key = date("H:i", strtotime("00:30 +" . $i * 15 . " minute"));
                $value = date("H時i分", strtotime("00:30 +" . $i * 15 . " minute"));
                $timetable += [
                    $key => $value,
                ];
            } else {
                $key = date("H:i", strtotime("00:00 +" . $i * 15 . " minute"));
                $value = date("H時i分", strtotime("00:00 +" . $i * 15 . " minute"));
                $timetable += [
                    $key => $value,
                ];
            }
        }


        $param = [
            'userslist' => $userslist,
            'timetable' => $timetable,
            'record' => $record,
        ];
        return view('admin.performance_edit', $param);
    }

    // 実績記録変更画面
    public function update(Request $request)
    {
        $performance = Performance::where('id', $request->id)->first();
        // すべてのリクエスト内容を取得
        $form = $request->all();
        // リクエスト内容から不要な '_token'を取り除く
        unset($form['_token']);
        $performance->fill($form)->save();
        $title = '変更完了';

        // $param = [
        //     'user' => $user,
        //     'title' => $title,
        // ];

        return  redirect('/performance/0');
        // return view('admin.user_successful', $param);
    }
}
