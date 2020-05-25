<?php

namespace App\Http\Controllers;

use App\User;
use App\School;
use Illuminate\Http\Request;

class UserManagerController extends Controller
{
    public function index(Request $request, $school_id)
    {
        $schools =  School::all();

        if (empty($school_id)) {
            $users = User::paginate(10);
        } else {
            $users = User::schoolIdEqual($school_id)->paginate(10);
        }

        $param = [
            'users' => $users,
            'schools' => $schools,
             'school_id' =>  $school_id,
        ];
        return view('admin.user_record', $param);
    }

    public function select(Request $request)
    {
        $schoolno = $request->schoolno;

        if ($schoolno != 'all') {
            $users = User::schoolIdEqual($schoolno)->paginate(10);
        } else {
            $users = User::paginate(10);
        }

        $param = [
            'users' => $users,
        ];
        return view('admin.user_record', $param);
    }
}
