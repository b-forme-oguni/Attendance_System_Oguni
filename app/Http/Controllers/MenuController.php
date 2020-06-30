<?php

namespace App\Http\Controllers;

use App\School;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function top()
    {
        $schools =  School::all();
        $prame = [
            'schools' => $schools,
        ];
        return view('stamp.index', $prame);
    }

    public function menu()
    {
        return view('admin.menu');
    }

}
