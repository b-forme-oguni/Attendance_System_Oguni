<?php

namespace App\Http\Controllers;

use App\User;
use App\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $schools =  School::all();
        $prame = [
            'schools' => $schools,
        ];
        return view('user.index', $prame);
    }

    const PAGINATION_PER_PAGE = 50;

    public function stamp($id)
    {
        $school =  School::idEqual($id)->first();
        $users =  User::schoolIdEqual($id)
            ->orderBy(DB::raw(
                "case when last_name_kana is NULL then '2'" . // 1. NULLの場合は2番目
                    " when last_name_kana = '' then '1'" .        // 2. '' の場合は1番目
                    " else '0' end, " .                      // 3. 値が入っていたら0番目
                    "last_name_kana"                          // 4. ひらがな五十音順 *1
            ))->paginate(self::PAGINATION_PER_PAGE);


        $prame = [
            'school' => $school,
            'users' => $users,
        ];
        return view('user.stamp', $prame);
    }
}
