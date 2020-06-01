<?php

namespace App\Http\Controllers;

use App\School;
use App\Performance;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    public function index(Request $request, $school_id)
    {
        $schools =  School::all();

        if (empty($school_id)) {
            $performances = Performance::with('user')->with('note')->paginate(10);
        } else {
            $performances = Performance::schoolIdEqual($school_id)->with('user')->with('note')->paginate(10);
        }

        $param = [
            'performances' => $performances,
            'schools' => $schools,
            'school_id' =>  $school_id,
        ];
        return view('admin.performance_record', $param);
    }
}
