<?php

namespace App\Http\Controllers;

use App\School;
use App\User;
use Illuminate\Http\Request;

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

    public function stamp($id)
    {
        $school =  School::idEqual($id)->first();
        $users =  User::schoolIdEqual($id)->get();

        $prame = [
            'school' => $school,
            'users' => $users,
        ];
        return view('user.stamp', $prame);
    }
}
