<?php

namespace App\Http\Controllers;

use App\User;
use App\School;
use Illuminate\Http\Request;

class UserManagerController extends Controller
{
    // 利用者一覧表示
    public function index(Request $request, $school_id)
    {
        $schools =  School::all();

        if (empty($school_id)) {
            $users = User::with('school')->paginate(10);
        } else {
            $users = User::schoolIdEqual($school_id)->with('school')->paginate(10);
        }

        $param = [
            'users' => $users,
            'schools' => $schools,
            'school_id' =>  $school_id,
        ];
        return view('admin.user_record', $param);
    }

    // 利用者登録画面
    public function register(Request $request)
    {
        $schools =  School::all();
        $param = [
            'schools' => $schools,
        ];
        return view('admin.user_register', $param);
    }

    // 利用者登録処理
    public function store(Request $request)
    {
        $this->validate($request, User::$rulse);
        $user = new User;
        $form = $request->all();
        unset($form['_token']);
        $user->fill($form)->save();
        $title = '登録完了';

        $param = [
            'user' => $user,
            'title' => $title,
        ];
        return view('admin.user_successful', $param);
    }

    // 利用者情報変更画面
    public function edit(Request $request)
    {
        $schools =  School::all();
        $user = User::where('id', $request->id)->first();
        $param = [
            'user' => $user,
            'schools' => $schools,
            'school_id' =>  $user->school_id - 1,
        ];
        return view('admin.user_edit', $param);
    }

    // 利用者情報変更処理
    public function update(Request $request)
    {
        $this->validate($request, User::$rulse);
        $user = User::where('id', $request->id)->first();
        $user->update([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'last_name_kana' => $request->last_name_kana,
            'first_name_kana' => $request->first_name_kana,
            'school_id' => $request->school_id,
        ]);
        $title = '変更完了';

        $param = [
            'user' => $user,
            'title' => $title,
        ];
        return view('admin.user_successful', $param);
    }
}
