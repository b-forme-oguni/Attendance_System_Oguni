<?php

namespace App\Http\Controllers;

use App\School;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $schools =  School::all();
        $prame = [
            'schools' => $schools,
        ];
        return view('user.index', $prame);
    }
}
