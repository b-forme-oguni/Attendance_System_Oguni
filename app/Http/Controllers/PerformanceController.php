<?php

namespace App\Http\Controllers;

use App\Note;
use App\User;
use App\School;
use App\Performance;
use app\Library\BaseClass;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    // 実績記録一覧表示
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

    // 実績記録登録画面
    public function register(Request $request)
    {
        $param = [
            'todaydate' => BaseClass::toDayDate(),
            'userslist' => BaseClass::usersList(),
            'noteslist' => BaseClass::notesList(),
            'timetable' => BaseClass::timeTable(),
        ];
        return view('admin.performance_register', $param);
    }

    // 実績記録登録処理
    public function store(Request $request)
    {
        // リクエストされた内容に対して、Userクラスのバリデータールールを適用
        // ルール違反の場合、登録を受付けない
        // $this->validate($request, User::$rulse);

        // すべてのリクエスト内容を取得
        $form = $request->all();
        // リクエスト内容から不要な '_token'を取り除く
        unset($form['_token']);
        // Modelクラスを生成して、Form内容を一括（fill）で入力し、DBに保存（save）する
        $record = new Performance();
        $record->fill($form)->save();
        $title = '登録完了';

        $param = [
            'record' => $record,
            'title' => $title,
        ];
        return view('admin.performance_successful', $param);
    }

    // 実績記録変更画面
    public function edit(Request $request)
    {
        // クエリから指定したidのレコードを取得
        $record = Performance::where('id', $request->id)->first();

        // food_fgフラグに真偽値を入力
        if (!empty($record->food_fg)) {
            $food_fg = true;
        } else {
            $food_fg = false;
        }

        // outside_fgフラグに真偽値を入力
        if (!empty($record->outside_fg)) {
            $outside_fg = true;
        } else {
            $outside_fg = false;
        }

        // medical_fgフラグに真偽値を入力
        if (!empty($record->medical_fg)) {
            $medical_fg = true;
        } else {
            $medical_fg = false;
        }

        $param = [
            'record' => $record,
            'food_fg' => $food_fg,
            'outside_fg' => $outside_fg,
            'medical_fg' => $medical_fg,
            'userslist' => BaseClass::usersList(),
            'noteslist' => BaseClass::notesList(),
            'timetable' => BaseClass::timeTable(),
        ];
        return view('admin.performance_edit', $param);
    }

    // 実績記録変更画面
    public function update(Request $request)
    {
        $record = Performance::where('id', $request->id)->first();
        // すべてのリクエスト内容を取得
        $form = $request->all();
        // リクエスト内容から不要な '_token'を取り除く
        unset($form['_token']);
        $record->fill($form)->save();
        $title = '変更完了';

        $param = [
            'record' => $record,
            'title' => $title,
        ];

        // return  redirect('/performance/0');
        return view('admin.performance_successful', $param);
    }



    // 実績記録情報削除
    public function delete(Request $request)
    {
        // クエリのUserIDのレコードをソフトデリート
        $record = Performance::where('id', $request->id)->first();
        $record->delete();
        $title = '削除完了';

        $param = [
            'record' => $record,
            'title' => $title,
        ];
        return view('admin.performance_successful', $param);
    }
}
